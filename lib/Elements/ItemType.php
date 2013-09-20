<?php

namespace Elements;

class ItemType extends AbstractApiHandler {

	public static function findItemTypeById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function findItemTypeByExternalId($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::getCall($params, $apiAuth);
	}

	public static function addItemType($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}

	public static function updateItemType($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function getItemTypes($params = null, $apiAuth = null) {
		return self::getCall('itemTypes', $params, $apiAuth);
	}

}