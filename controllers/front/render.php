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
		$this->context->controller->addJS('module:configurator/views/js/front.js');
		$this->context->controller->addCSS('module:configurator/views/css/front.css');
		$this->context->controller->addCSS('module:configurator/views/css/jquery-ui.css');
		$this->setTemplate('module:configurator/views/templates/front/render.tpl');
	}
	public function clean_string($string){
		return htmlspecialchars(preg_replace('#<script(.*?)>(.*?)</script>#is', '', $string));
	}

	public function postProcess( ) {

		if( Tools::isSubmit('saveForm') ){

			$token = Tools::getValue('csrf_token');
			if($token == $this->context->cookie->inquiry_token){

				$shape = Tools::getValue('shape');
				$shape_other = $this->clean_string(Tools::getValue('shape-other'));

				$blat = Tools::getValue('blat');

				$type = $this->clean_string(Tools::getValue('type'));

				$size = $this->clean_string(Tools::getValue('size'));

				$base = Tools::getValue('base');
				$base_other = $this->clean_string(Tools::getValue('base-other'));



				$email = Tools::getValue('email');
				$telephone = Tools::getValue('telephone');
				$text = $this->clean_string(Tools::getValue('text'));

				$template_path = dirname(__FILE__).'/mails/';

				$success = Mail::Send(
					$this->context->language->id,
					'inquiry',
					'Zapytanie',
					array(
						'{shape}' => $shape ? $shape: " - ",
						'{shape_other}' => $shape_other ? $shape_other: " - ",
						'{blat}' => $blat ? $blat : " - ",
						'{size}' => $size ? $size : " - ",
						'{base}' => $base ? $base : " - ",
						'{base_other}' => $base_other ? $base_other : " - ",
						'{type}' => $type ? $type : " - ",

						'{email}' => $email, // sender email address
						'{telephone}' => $telephone, // sender email address
						'{message}' => $text // email content
					),
					Configuration::get('PS_SHOP_EMAIL'),
					null,
					$email
				);

				if ($success){
					$sql = "
						INSERT INTO "._DB_PREFIX_."configurator_inquiry (mail,telephone,text)
						VALUES ('$email','$telephone','$text')
					";
					$this->success[] = 'Wysłano wiadomość z konfiguratora';
					$this->redirectWithNotifications($this->getCurrentURL());
					$db = Db::getInstance()->execute($sql);

				}else{
					$this->errors[] = "błąd formularza";
					$this->redirectWithNotifications($this->getCurrentURL());
				}
				$this->context->cookie->inquiry_token = "";
			}


		}
	}
}

