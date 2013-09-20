<?php

namespace Elements;

class ForexOffer extends AbstractApiHandler {

	public static function findForexOfferById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function findForexOfferByExternalKey($params = null, $apiAuth = null) {
		$base = self::name();
		return self::getCall($base, $params, $apiAuth);
	}

	public static function addForexOffer($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}

	public static function updateForexOffer($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function getForexOffers($params = null, $apiAuth = null) {
		return self::getCall('forexOffers', $params, $apiAuth);
	}
}