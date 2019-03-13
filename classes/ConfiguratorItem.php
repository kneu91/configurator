<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 07.03.19
 * Time: 22:17
 */


namespace KnConfigurator\Classes;

use ObjectModel;

class ConfiguratorItem  extends ObjectModel{
	public static $definition = [
		'table' => 'configurator_item',
		'primary' => 'id_configurator_item',
		'multilang' => false,
		'fields' => array(
			'id_configurator_item'  => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
//			'position'         => ['type' => self::TYPE_INT],
//			'active'           => ['type' => self::TYPE_BOOL],


			'value'       => [
				'type' => self::TYPE_STRING,
				'lang' => true,
				'validate' => 'isGenericName',
				'required' => true,
				'size' => 255
			],

		)
	];
}