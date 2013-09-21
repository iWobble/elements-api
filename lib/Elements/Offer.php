<?php

namespace Elements;

class Offer extends AbstractApiHandler {

	public static function addOffer($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}

	public static function findOfferById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function updateOffer($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function findOfferByExternalKey($params = null, $apiAuth = null) {
		$base = self::name();
		return self::getCall($base, $params, $apiAuth);
	}

	public static function getOfferRecommendations($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = 'offer/recommendations';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}
	
}