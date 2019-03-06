<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 05.03.19
 * Time: 23:25
 */


namespace KnConfigurator\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ConfiguratorItem")
 */
class ConfiguratorItem {


	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	public $id;


	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
		return $this;
	}
}