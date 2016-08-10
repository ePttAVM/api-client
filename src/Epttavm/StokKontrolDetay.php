<?php
/**
 * Created by PhpStorm.
 * User: canyildiz
 * Date: 08.07.2016
 * Time: 14:22
 */

namespace Epttavm;
use Epttavm\Exception\EpaException;

/**
 * @method StokKontrolDetay setUrunId(int $urunId)
 * @method StokKontrolDetay setShopId(int $shopId)
 * @method StokKontrolDetay setBarkod(string $barkod)
 * @method StokKontrolDetay setDurum(int $Durum)
 * @method StokKontrolDetay setUrunAdi(string $UrunAdi)
 * @method StokKontrolDetay setAciklama(string $Aciklama)
 * @method StokKontrolDetay setUzunAciklama(string $UzunAciklama)
 * @method StokKontrolDetay setMiktar(int $Miktar)
 * @method StokKontrolDetay setKDVsiz(float $KDVsiz)
 * @method StokKontrolDetay setKDVli(float $KDVli)
 * @method StokKontrolDetay setKDVOran(float $KDVOran)
 * @method StokKontrolDetay setIskonto(int $Iskonto)
 * @method StokKontrolDetay setAktif(bool $Aktif)
 * @method StokKontrolDetay setMevcut(bool $Mevcut)
 * @method StokKontrolDetay setAgirlik(float $Agirlik)
 * @method StokKontrolDetay setBoyX(int $BoyX)
 * @method StokKontrolDetay setBoyY(int $BoyY)
 * @method StokKontrolDetay setBoyZ(int $BoyZ)
 * @method StokKontrolDetay setDesi(float $Desi)
 * @method StokKontrolDetay setResim1Url(string $Resim1Url)
 * @method StokKontrolDetay setResim2Url(string $Resim2Url)
 * @method StokKontrolDetay setResim3Url(string $Resim3Url)
 * @method StokKontrolDetay setKategoriBilgisiGuncelle(int $KategoriBilgisiGuncelle)
 * @method StokKontrolDetay setAnaKategoriId(int $AnaKategoriId)
 * @method StokKontrolDetay setAltKategoriId(int $AltKategoriId)
 * @method StokKontrolDetay setAltKategoriAdi(string $AltKategoriAdi)
 * @method StokKontrolDetay setUrunUrl(string $UrunUrl)
 * @method StokKontrolDetay setTag(string $Tag)
 * @method StokKontrolDetay setUrunKodu(string $UrunKodu)
 * @method StokKontrolDetay setTedarikciAltKategoriId(int $TedarikciAltKategoriId)
 * @method StokKontrolDetay setTedarikciAltKategoriAdi(string $TedarikciAltKategoriAdi)
 * @method StokKontrolDetay setTedarikciSanalKategoriId(int $TedarikciSanalKategoriId)
 * @method StokKontrolDetay setVariantListesi(Variants[] $VariantListesi)
 * @method StokKontrolDetay setGarantiSuresi(int $GarantiSuresi)
 * @method StokKontrolDetay setGarantiVerenFirma(string $GarantiVerenFirma)
 *
 */

class StokKontrolDetay extends BaseDataContract
{
	static protected $_properties = [
		'UrunId',
		'ShopId',
		'Durum',
		'Barkod',
		'UrunAdi',
		'Aciklama',
		'UzunAciklama',
		'Miktar',
		'KDVsiz',
		'KDVli',
		'KDVOran',
		'Iskonto',
		'Aktif',
		'Mevcut',
		'Agirlik',
		'BoyX',
		'BoyY',
		'BoyZ',
		'Desi',
		'Resim1Url',
		'Resim2Url',
		'Resim3Url',
		'KategoriBilgisiGuncelle',
		'AnaKategoriId',
		'AltKategoriId',
		'AltKategoriAdi',
		'UrunUrl',
		'Tag',
		'UrunKodu',
		'Resim1Stream',
		'Resim2Stream',
		'Resim3Stream',
		'TedarikciAltKategoriId',
		'TedarikciAltKategoriAdi',
		'TedarikciSanalKategoriId',
		'VariantListesi',
		'GarantiSuresi',
		'GarantiVerenFirma',
	];

	protected function _validateData()
	{
		if (isset($this->Durum)) {
			if (!in_array($this->Durum, [KayitDurum::MEVCUT, KayitDurum::YENI]))
				throw new EpaException(sprintf('Geçersiz Durum Türü: %s', $this->Durum));
			if ($this->Durum === KayitDurum::YENI)
				unset($this->UrunId);
		}

		if (isset($this->Agirlik))
			$this->Agirlik = floatval($this->Agirlik);
	}
}