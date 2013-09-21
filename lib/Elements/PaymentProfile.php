<?php


namespace Elements;


class PaymentProfile extends AbstractApiHandler {

	public static function findPaymentProfileById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function getPaymentProfiles($params = null, $apiAuth = null) {
		return self::getCall('paymentProfiles', $params, $apiAuth);
	}

	public static function addPaymentProfile($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('post', $url, $params); 
		return self::processResponse($response);
	}

	public static function updatePaymentProfile($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('post', $url, $params); 
		return self::processResponse($response);
	}

	public static function deletePaymentProfile($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('delete', $url, $params); 
		return self::processResponse($response);	
	}
}