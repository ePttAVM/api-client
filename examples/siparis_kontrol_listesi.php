<?php
require_once __DIR__.'/../vendor/autoload.php';

use Epttavm\ApiClient;
use Epttavm\Exception\EpaException;

try {
    $a = ApiClient::init('https://exact.service.url/service?wsdl', 'username', 'password', ['debug'=>false]);
    
    $date1 = new DateTime('2018-01-01 00:00:00');
    $date2 = new DateTime(); // now()
    $result = $a->SiparisKontrolListesiV2($date1, $date2, 0);
    
    print_r($result);

} catch (EpaException $e) {
	echo "HATA OLDU:\n".$e->getMessage();
}
