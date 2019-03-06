<?php
/**
* 2007-2019 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}


class Configurator extends Module
{
    protected $config_form = false;

	public $tabs = array(
		array(
			'name' => array(
				'en' => 'Inquires', // Default value should be first
				'pl' => 'Zapytania',

        ),
	        'class_name' => 'AdminConfiguratorInquiryList',
	        'parent_class_name' => 'AdminParentOrders',
		)
	);


    public function __construct()
    {
        $this->name = 'configurator';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'kneuman';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Konfigurator');
        $this->description = $this->l('konfigurator do generowania ');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('CONFIGURATOR_LIVE_MODE', false);

        return parent::install() &&
            $this->installDB() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader');
    }

    public function uninstall()    {
	    $var = $this->uninstallTab('AdminConfiguratorInquiryList');


        return parent::uninstall();
    }
	



    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitConfiguratorModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output.$this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitConfiguratorModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Live mode'),
                        'name' => 'CONFIGURATOR_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Enter a valid email address'),
                        'name' => 'CONFIGURATOR_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                    ),
                    array(
                        'type' => 'password',
                        'name' => 'CONFIGURATOR_ACCOUNT_PASSWORD',
                        'label' => $this->l('Password'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return array(
            'CONFIGURATOR_LIVE_MODE' => Configuration::get('CONFIGURATOR_LIVE_MODE', true),
            'CONFIGURATOR_ACCOUNT_EMAIL' => Configuration::get('CONFIGURATOR_ACCOUNT_EMAIL', 'contact@prestashop.com'),
            'CONFIGURATOR_ACCOUNT_PASSWORD' => Configuration::get('CONFIGURATOR_ACCOUNT_PASSWORD', null),
        );
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

	private function installDB(){
		/*return (
			(Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'configurator`') &&
			 Db::getInstance()->Execute('
			CREATE TABLE `'._DB_PREFIX_.'configurator` (
					`id_configurator` int(10) unsigned NOT NULL AUTO_INCREMENT,
					`word` VARCHAR(100),
					`url` VARCHAR(100),
					`in_use` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
					PRIMARY KEY (`id_configurator`)
			) ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;') )&&
			(Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'configurator_item`') &&
			 Db::getInstance()->Execute('
			CREATE TABLE `'._DB_PREFIX_.'configurator_item` (
					`id_configurator_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
					`id_seo` int(10),
					`id_product` int(10),
					PRIMARY KEY (`id_seotable`)
			) ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;') )&&
			(Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'configurator_option`') &&
			 Db::getInstance()->Execute('
			CREATE TABLE `'._DB_PREFIX_.'configurator_option` (
					`id_seocheck` int(10) unsigned NOT NULL AUTO_INCREMENT,
					`id_product` int(10),
					`id_seo` int(10),
					`name` VARCHAR(128),
					`quantity` int(10),
					PRIMARY KEY (`id_seocheck`)
			) ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;'))
		);*/
		return (
			Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'inquiry`') &&
		    Db::getInstance()->Execute('
			CREATE TABLE `'._DB_PREFIX_.'inquiry` (
					`id_inquiry` int(10) unsigned NOT NULL AUTO_INCREMENT,
					`mail` VARCHAR(100),
					`telephone` VARCHAR(100),	
					`text` VARCHAR(255),	 				
					PRIMARY KEY (`id_inquiry`)
			) ENGINE = '._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;') );
	}
}
