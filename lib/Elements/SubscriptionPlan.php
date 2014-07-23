<?php

namespace Elements;

class SubscriptionPlan extends AbstractApiHandler {

	public static function addSubscriptionPlan($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}

	public static function updateSubscriptionPlanById($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function findSubscriptionPlanById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function getSubscriptionPlans($params = null, $apiAuth = null) {
		return self::getCall('subscriptionPlans', $params, $apiAuth);
	}
		
}