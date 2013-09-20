<?php

namespace Elements;

class Fts extends AbstractApiHandler {

	public static function buildStoreOffersIndex($params = null, $apiAuth = null) {
		return self::getCall('fts/index', $params, $apiAuth);
	}

	public static function searchOffers($params = null, $apiAuth = null) {
		return self::getCall('fts/search', $params, $apiAuth);
	}
}