<?php

namespace Elements;

class GovernmentEntity extends AbstractApiHandler {

	public static function addGovernmentEntity() {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}

	public static function findGovernmentEntityById() {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function updateGovernmentEntity() {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function findGovernmentEntities($params = null, $apiAuth = null) {
		return self::getCall('governmentEntities', $params, $apiAuth);
	}
}