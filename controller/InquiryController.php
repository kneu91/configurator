<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 06.03.19
 * Time: 22:21
 */

namespace KnConfigurator\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class InquiryController extends FrameworkBundleAdminController{

	public function inquiryListAction(){
		$list = [];



		return $this->render('@Modules/configurator/views/templates/admin/list.html.twig',[
			'list' => $list
		]);
	}

}