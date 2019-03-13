<?php

class Inquiry extends ObjectModel {


	public $mail;

	public $telephone;

	public $text;

	public static $definition = [
		'table' => 'inquiry',
		'primary' => 'id_inquiry',
		'multilang' => false,
		'fields' => array(

//			'position'         => ['type' => self::TYPE_INT],
//			'active'           => ['type' => self::TYPE_BOOL],

			// Language fields
			'mail' => [
				'type' => self::TYPE_STRING,
				'lang' => true,
				'validate' => 'isGenericName',
				'size' => 100
			],
			'telephone'    => [
				'type' => self::TYPE_STRING,
				'lang' => true,
				'validate' => 'isGenericName',
				'size' => 100
			],
			'text'       => [
				'type' => self::TYPE_STRING,
				'lang' => true,
				'validate' => 'isGenericName',
				'required' => true,
				'size' => 255
			],

		)
	];

}