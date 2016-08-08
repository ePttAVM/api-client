<?php
/**
 * Created by PhpStorm.
 * User: canyildiz
 * Date: 08.08.2016
 * Time: 17:31
 */

use Epttavm\Library\Config;
use Symfony\Component\Yaml\Yaml;

$filepath = __DIR__.'/../epttavm.yml';
if (!file_exists($filepath))
	throw new \Exception('Config file not found at '.$filepath);
$config = Yaml::parse(file_get_contents($filepath), Yaml::PARSE_OBJECT_FOR_MAP);
Config::init($config);