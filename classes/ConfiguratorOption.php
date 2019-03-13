<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 07.03.19
 * Time: 22:16
 */

namespace KnConfigurator\Classes;

use ObjectModel;
class ConfiguratorOption  extends ObjectModel {
	public static $definition = [
		'table' => 'configurator_option',
		'primary' => 'id_configurator_option',
		'multilang' => false,
		'fields' => array(
			'id_configurator_option'  => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
			'position'         => ['type' => self::TYPE_INT],
			'active'           => ['type' => self::TYPE_BOOL],

			// Language fields
			'name' => [
				'type' => self::TYPE_STRING,
				'lang' => true,
				'validate' => 'isGenericName',
				'size' => 100
			],



		)
	];
}