<?php
/**
 * Created by PhpStorm.
 * User: canyildiz
 * Date: 08.08.2016
 * Time: 17:57
 */

namespace Epttavm;

/**
 * Class Variants
 * @package Epttavm
 *
 * @method Variants setDurum(int $duurm)
 * @method Variants setAnaUrunKodu(string $anaUrunKodu)
 * @method Variants setVariantBarkod(string $barkod)
 * @method Variants setVariant1Deger(string $variant1Deger)
 * @method Variants setVariant2Deger(string $variant2Deger)
 * @method Variants setMiktar(int $miktar)
 * @method Variants setFiyat(float $fiyat)
 * @method Variants setFiyatFarkiMi(bool $fiyatFarki)
 * @method Variants setKayitDegisti(int $kayitDegisti)
 * @method Variants setGuncellemeSonucu(string $sonuc)
 */
class Variants extends BaseDataContract
{
	static protected $_properties = [
		'Durum',
		'AnaUrunKodu',
		'VariantBarkod',
		'Variant1Deger',
		'Variant2Deger',
		'Miktar',
		'Fiyat',
		'FiyatFarkiMi',
		'KayitDegisti',
		'GuncellemeSonucu'
	];
}