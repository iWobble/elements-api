<?php

namespace Elements;

class ItemInstance extends AbstractApiHandler {

	public static function findItemInstanceById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function addItemInstance($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}

	public static function updateInstance($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function getItemInstances($params = null, $apiAuth = null) {
		return self::getCall('itemInstances', $params, $apiAuth);
	}

	public static function getShippingReport($params = null, $apiAuth = null) {
		return self::getCall('shippingReport', $params, $apiAuth);
	}

	public static function startItemInstanceExpiration($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/startExpiration';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);	
	}

	public static function updateItemInstanceExpirationDate($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/expirationDate';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}
}