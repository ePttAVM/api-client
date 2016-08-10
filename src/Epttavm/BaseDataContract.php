<?php
/**
 * Created by PhpStorm.
 * User: canyildiz
 * Date: 08.08.2016
 * Time: 17:59
 */

namespace Epttavm;

use Epttavm\Exception\EpaException;

abstract class BaseDataContract
{
	static protected $_properties = [];

	protected function __construct() {}

	public static function create() {
		return new static();
	}

	public function __call($name, $arguments)
	{
		if (preg_match('/^set[A-Z][A-Za-z0-9]+$/',$name))
		{
			$propertyName = preg_replace('/^set([A-Z][A-Za-z0-9]+)$/', '$1', $name);
			if(!in_array($propertyName, static::$_properties))
				throw new EpaException('Invalid property name!');
			$this->{$propertyName} = $arguments[0];
			$this->_validateData();
			return $this;
		}
		print_r(static::$_properties);
		throw new EpaException(sprintf('Invalid method: %s::%s', static::class, $name));
	}

	protected function _validateData(){

	}
}