<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 04.03.19
 * Time: 19:03
 */
class ConfiguratorRenderModuleFrontController extends ModuleFrontController{

	/**
	 * Assign template vars related to page content.
	 *
	 * @see FrontController::initContent()
	 */


	public function initContent(){

		parent::initContent();



		$this->context->smarty->assign([

		]);
		// Will use the file modules/cheque/views/templates/front/validation.tpl
		$this->setTemplate('module:configurator/views/templates/front/render.tpl');
	}


	public function postProcess( ) {

		if( Tools::isSubmit('saveForm') ){
			// todo reszta
			$template_path = dirname(__FILE__).'/mails/';
			$success = Mail::Send((int)(Configuration::get('PS_LANG_DEFAULT')), // defaut language id
				'inquiry', // email template file to be use
				'Zapytanie', // email subject
				array(
					/*'{email}' => Configuration::get('PS_SHOP_EMAIL'), // sender email address
					'{message}' => $this->displayName.' has been installed on:'._PS_BASE_URL_.__PS_BASE_URI__ // email content*/
				),
				'sznojman@gmail.com', // receiver email address
				NULL, NULL, NULL,
				$template_path
			);
			if($success){

			}

		}
	}
}

