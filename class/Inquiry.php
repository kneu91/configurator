<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 06.03.19
 * Time: 22:28
 */

class Inquiry extends ObjectModel {


	public $mail;

	public $telephone;

	public $text;

	public static $definition = [
		'table' => 'inquiry',
		'primary' => 'id_inquiry',
		'multilang' => false,
		'fields' => array(
			'id_cms_category'  => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
			'position'         => ['type' => self::TYPE_INT],
			'active'           => ['type' => self::TYPE_BOOL],

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