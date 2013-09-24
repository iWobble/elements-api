<?php

abstract class ElementsTest extends UnitTestCase {

	public function setUp() {
		\Elements::setBaseUrl('https://delldev.tfelements.com');
		\Elements::setPartnerId('$apiactor');
		\Elements::setAppFamilyId('1379720147766');
		\Elements::setAccessKey('HPPhSwLraz');
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
