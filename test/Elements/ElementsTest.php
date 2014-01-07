<?php

abstract class ElementsTest extends UnitTestCase {

	public function setUp() {
		$baseUrl = getEnv('ELEMENTS_BASEURL');
		$partnerId = getEnv('ELEMENTS_PARTNER_ID');
		$appFamilyId = getEnv('ELEMENTS_APP_FAMILY_ID');
		$accessKey = getEnv('ELEMENTS_ACCESS_KEY');

		#if (!$baseUrl || !$partnerId || !$appFamilyId || !$accessKey) {
		#	die("You must set Enviroment Variables: ELEMENTS_BASEURL, ELEMENTS_PARTNER_ID, ELEMENTS_APP_FAMILY_ID, ELEMENTS_KEY\n");
		#}
		
		#\Elements::setBaseUrl($baseUrl);
		#\Elements::setPartnerId($partnerId);
		#\Elements::setAppFamilyId($appFamilyId);
		#\Elements::setAccessKey($accessKey);

		\Elements::setBaseUrl('https://delldev.tfelements.com');
		\Elements::setPartnerId('$apiactor');
		\Elements::setAppFamilyId('1379720147766');
		\Elements::setAccesskey('HPPhSwLraz');
	}

	protected static function randomString() {
		$chars = "abcdefghijklmnopqrstuvwxyz";
		$str = "";
		for ($i = 0; $i < 10; $i++) {
			$str .= $chars[rand(0, strlen($chars)-1)];
		}
		return $str;
	}

}
