<?php
/**
 * Created by PhpStorm.
 * User: canyildiz
 * Date: 08.07.2016
 * Time: 14:20
 */
require_once __DIR__.'/../vendor/autoload.php';

use Epttavm\ApiClient;
use Epttavm\Exception\ConfigException;
use Epttavm\Exception\EpaException;
use Epttavm\KayitDurum;
use Epttavm\Library\Config;
use Epttavm\StokKontrolDetay;
use Epttavm\Variants;

try {
	$config = Config::getInstance();
	$a = ApiClient::init($config->web_service->wsdl, $config->web_service->username, $config->web_service->password, ['debug'=>false]);

	//Birinci varyant
	$v1 = Variants::create()
		->setVariant1Deger('XL')
		->setVariant2Deger('Beyaz')
		->setMiktar(10)
		->setVariantBarkod('Var-001')
		->setFiyat(100.00)
		->setFiyatFarkiMi(false);

	//İkinci varyant
	$v2 = Variants::create()
		->setVariant1Deger('L')
		->setVariant2Deger('Siyah')
		->setMiktar(12)
		->setVariantBarkod('Var-002')
		->setFiyat(105.00)
		->setFiyatFarkiMi(false);

	//Stok Detay
	$s = StokKontrolDetay::create()
		->setUrunId('a')
		->setShopId(3334)
		->setBarkod('Urun-001')
		->setDurum(KayitDurum::MEVCUT)
		->setUrunAdi('Ürün Adı 001')
		->setAnaKategoriId(129)
		->setAltKategoriId(2425)
		->setTag('test-tag')
		->setKDVsiz(12.34)
		->setAciklama('Ürün Açıklama')
		->setVariantListesi([$v1, $v2])
		->setResim1Url('https://lh3.googleusercontent.com/-qdwFGB4s4L0/AAAAAAAAAAI/AAAAAAAAAC0/EQxe1kOm1pI/w800-h800/photo.jpg')
		->setAktif(1);

	$res = $a->StokGuncelle($s);
	if($res)
		echo "BAŞARILI!\n";
	else
		echo "İŞLEM BAŞARISIZ!\n";
} catch (ConfigException $e) {
	echo "CONFIG HATASI\n";
	die($e->getMessage());
} catch (EpaException $e) {
	echo "HATA OLDU:\n".$e->getMessage();
}
