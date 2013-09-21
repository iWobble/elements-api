<?php

use Elements\ElementsException;

abstract class Elements {

	public static $baseUrl = "https://api.lgelements.com";

	public static $partnerId;

	public static $accessKey;

	public static $appFamilyId;

	public static $useSignatureAuth = false;

	public static $signature;

	const VERSION = 'v2';

	public static function setBaseUrl($baseUrl) {
		self::$baseUrl = $baseUrl;
	}

	public static function getBaseUrl() {
		return self::$baseUrl;
	}

	public static function setPartnerId($partnerId) {
		self::$partnerId = $partnerId;
	}	

	public static function getPartnerId() {
		return self::$partnerId;
	}

	public static function setAccessKey($accessKey) {
		self::$accessKey = $accessKey;
	}

	public static function getAccessKey() {
		return self::$accessKey;
	}

	public static function setAppFamilyId($appFamilyId) {
		self::$appFamilyId = $appFamilyId;
	}

	public static function getAppFamilyId() {
		return self::$appFamilyId;
	}

	public static function generateSignature($secret, $partnerId = null, $appFamilyId = null) {
		if (isset($partnerId)) {
			self::setPartnerId($partnerId);
		}

		if (isset($appFamilyId)) {
			self::setAppFamilyId($appFamilyId);
		}

		if (!self::getPartnerId()) {
			throw new ElementsException('You must first set the Partner ID to generate a signature');
		}

		if (!self::getAppFamilyId()) {
			throw new ElementsException('You must first set the App Family ID to generate a signature');
		}

		self::$useSignatureAuth = true;

		$string = self::getPartnerId() . self::getAppFamilyId() . gmmktime();

		self::$signature = hash_hmac("sha256", $string, $secret);
		return self::$signature;
	}

}
