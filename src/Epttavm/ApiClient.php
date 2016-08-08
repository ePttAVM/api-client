<?php
/**
 * Created by PhpStorm.
 * User: canyildiz
 * Date: 08.07.2016
 * Time: 14:07
 */

namespace Epttavm;

use Epttavm\Exception\EpaException;

class ApiClient
{
	static $instance = [];

	private $debug = false;
	
	private function __construct($wsdl, $u, $p, $options = []) {
		$this->debug = (isset($options['debug']) && $options['debug']);
		$opts = array(
			'http'=>array(
				'user_agent' => 'PHPSoapClient'
			),
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		$context = stream_context_create($opts);
		ini_set("default_socket_timeout", 90);
		try {
			$this->client = new \SoapClient($wsdl, [
				'soap_version' => SOAP_1_1,
				'stream_context' => $context,
				'exceptions' => true,
				'cache_wsdl' => WSDL_CACHE_NONE,
				'connection_timeout' => 120,
				'trace' => true,
				'allow_self_signed' => true
			]);
			$securityHeader = new EpaApiHeader($u, $p);
			$this->client->__setSoapHeaders([$securityHeader]);

		} catch (\Exception $e) {
			if ($this->debug) {
				echo "ERROR:\n".$e->getMessage()."\n";
				echo "TRACE:\n".$e->getTraceAsString()."\n";
				echo "REQUEST:\n".$this->client->__getLastRequest()."\n";
				echo "REQUEST HEADERS:\n".$this->client->__getLastRequestHeaders()."\n";
				echo "RESPONSE:\n".$this->client->__getLastResponse()."\n";
			}
		}
	}

	/**
	 * @param string  $wsdl     API WSDL adresi
	 * @param string  $username API Kullanıcı Adı
	 * @param string  $password API Parola
	 * @param array   $options  Ekstra Seçenekler
	 *
	 * @return static
	 */
	public static function init($wsdl, $username, $password, $options = []) {
		if (empty($wsdl) || empty($username) || empty($password))
			throw new EpaException('Şu parametreler boş olamaz: wsdl, username, password');
		$k = md5($wsdl.$username.$password);
		if (!isset(self::$instance[$k]))
			self::$instance[$k] = new self($wsdl, $username, $password, $options);
		return self::$instance[$k];
	}

	/**
	 * @param $name
	 * @param $arguments
	 *
	 * @throws EpaException
	 */
	public function __call($name, $arguments)
	{
		try {
			return $this->client->__call($name, $arguments);
		} catch (\SoapFault $e) {
			if ($this->debug) {
				echo "ERROR:\n".$e->getMessage()."\n";
				echo "ERROR CODE:\n".$e->faultcode."\n";
				echo "TRACE:\n".$e->getTraceAsString()."\n";
			}
			throw new EpaException(sprintf('[%s] %s', $e->faultcode, $e->getMessage()), 500);
		}
	}

	/**
	 * @param StokKontrolDetay $stokKontrolDetay
	 *
	 * @return mixed
	 * @throws EpaException
	 */
	public function StokGuncelle(StokKontrolDetay $stokKontrolDetay)
	{
		$params = new \stdClass();
		$params->item = $stokKontrolDetay;
		$res = $this->__call('StokGuncelle',[$params]);
		if ($this->debug)
		{
			echo "REQUEST:\n".$this->client->__getLastRequest()."\n";
			echo "REQUEST HEADERS:\n".$this->client->__getLastRequestHeaders()."\n";
			echo "RESPONSE:\n".$this->client->__getLastResponse()."\n";
		}
		if($res && isset($res->StokGuncelleResult))
			$res = $res->StokGuncelleResult;
		return $res;
	}

}