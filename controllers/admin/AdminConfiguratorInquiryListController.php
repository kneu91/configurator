<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 06.03.19
 * Time: 22:45
 */

class AdminConfiguratorInquiryListController extends ModuleAdminController{



	public function __construct()
	{

		// Set variables
		$this->table = 'inquiry';
		$this->className = 'test';
		$this->fields_list = array(
			'id_inquiry' => array('title' => 'id', 'align' =>	'center', 'width' => 25),

			'mail' => array('title' => 'email', 'width' => 150)


		);
		$this->addRowAction('edit');
		$this->addRowAction('view');
		$this->addRowAction('delete');
		// Enable bootstrap

		$this->bulk_actions = array(
			'delete' => array(
				'text' => 'usunąć?',
				'confirm' => 'czy chcesz usunać?',
			)
		);

		$this->bootstrap = true;
		// Call of the parent constructor method
		parent::__construct();
	}

}