<?php

namespace Elements;

class CurrencyTransfers extends AbstractApiHandler {
	
	public static function getCurrencyTransfers($params = null, $apiAuth = null) {
		$base = self::name();
		return self::getCall($base, $params, $apiAuth);
	}

	public static function createCurrencyTransfer($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}
}