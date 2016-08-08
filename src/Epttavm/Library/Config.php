<?php
/**
 * Created by PhpStorm.
 * User: canyildiz
 * Date: 08.08.2016
 * Time: 17:37
 */

namespace Epttavm\Library;
use Epttavm\Exception\ConfigException;

/**
 * Class Config
 * @package Epttavm\Library
 * @property \stdClass web_service
 */
class Config
{
	static private $_instance;
	private $_attributes = [];

	/**
	 * Config constructor.
	 *
	 * @param \stdClass $config
	 *
	 * @throws ConfigException
	 */
	private function __construct($config)
	{
		if (!$config)
			throw new ConfigException('Config cannot be null!');
		if (!is_object($config))
			throw new ConfigException('Config must be an object!');
		$this->_attributes = $config;
	}

	/**
	 * @return self
	 * @throws \Exception
	 */
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			throw new ConfigException('Config not initialized yet! See: init()');
		}
		return self::$_instance;
	}
	/**
	 * @param \stdClass $config
	 *
	 * @return Config
	 *
	 * @throws ConfigException
	 */
	public static function init($config) {
		if (!isset(self::$_instance)) {
			self::$_instance = new self($config);
		}
		return self::$_instance;
	}

	/**
	 * @param string $name
	 *
	 * @return null
	 */
	public function __get($name)
	{
		if (isset($this->_attributes->$name))
			return $this->_attributes->$name;
		return null;
	}
}