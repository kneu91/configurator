<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 05.03.19
 * Time: 23:32
 */



namespace KnConfigurator\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ConfiguratorOptions")
 */
class ConfiguratorOptions {



	public $id;



	public function getId() {
		return $this->id;
	}

	public function setId( $id ) {
		$this->id = $id;
		return $this;
	}


}