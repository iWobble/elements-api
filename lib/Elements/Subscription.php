<?php

namespace Elements;

class Subscription extends AbstractApiHandler {

	public static function getSubscriptions($params = null, $apiAuth = null) {
		return self::getCall('subscriptions', $params, $apiAuth);
	}

	public static function updateSubscriptionById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function cancelSubscription($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('delete', $url, $params); 
		return self::processResponse($response);	
	}
}