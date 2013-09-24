<?php

abstract class ElementsTest extends UnitTestCase {

	public function setUp() {
		\Elements::setBaseUrl('https://delldev.tfelements.com');
		\Elements::setPartnerId('$apiactor');
		\Elements::setAppFamilyId('1379720147766');
		\Elements::setAccessKey('HPPhSwLraz');
	}

}
