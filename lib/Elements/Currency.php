<?php

namespace Elements;

class Currency extends AbstractApiHandler {

	public static function findCurrencyById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function getCurrencies($params = null, $apiAuth = null) {
		return self::getCall('currencies', $params, $apiAuth);
	}

	public static function addCurrency($params = null, $apiAuth = null) {
		$base = self::name();
		return self::getCall($base, $params, $apiAuth);
	}
}


