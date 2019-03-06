<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 04.03.19
 * Time: 22:43
 */


namespace KnConfigurator\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use KnConfigurator\Entity\ConfiguratorItem;
class ConfiguratorController extends FrameworkBundleAdminController{

		public function listConfiguratorAction(){
			$list = [];
			$cong = new ConfiguratorItem();

			$em = $this->getDoctrine()->getManager();


			return $this->render('@Modules/configurator/views/templates/admin/list.html.twig',[
				'list' => $list
			]);
		}


		public function addConfiguratorAction(){
			return $this->render('@Modules/configurator/views/templates/admin/list.html.twig',[

			]);
		}


}