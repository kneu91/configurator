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


		$token = md5(uniqid(rand(), TRUE));
		$this->context->cookie->inquiry_token = $token;

		$this->context->smarty->assign([
			'csrf_token' => $this->context->cookie->inquiry_token
		]);

		$this->setTemplate('module:configurator/views/templates/front/render.tpl');
	}


	public function postProcess( ) {

		if( Tools::isSubmit('saveForm') ){
			// todo reszta

			// check token
			$token = Tools::getValue('csrf_token');
			if($token == $this->context->cookie->inquiry_token){


				$email = Tools::getValue('email');
				$telephone = Tools::getValue('telephone');
				$text = htmlspecialchars(Tools::getValue('text'));



				$template_path = dirname(__FILE__).'/mails/';

				$success = Mail::Send(
					$this->context->language->id,
					'inquiry',
					'Zapytanie',
					array(
						'{email}' => $email, // sender email address
						'{telephone}' => $telephone, // sender email address
						'{message}' => $text // email content
					),
					Configuration::get('PS_SHOP_EMAIL')

				);

				$sql = "
					INSERT INTO "._DB_PREFIX_."configurator_inquiry (mail,telephone,text)
					VALUES ('$email','$telephone','$text')
				";

				$db = Db::getInstance()->execute($sql);

				$this->context->cookie->inquiry_token = "";
			}


		}
	}
}

