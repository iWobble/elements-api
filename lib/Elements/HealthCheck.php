<?php

namespace Elements;

class HealthCheck extends AbstractApiHandler {

	public static function getHealthCheck($apiAuth = null) {
		$url = self::getBaseUrl(self::name());
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, null); 
		list($name, $statusStr ) = explode(': ', $response);
		$status = array('status' => array());
		if ($statusStr) {
			foreach (explode(", ", $statusStr) as $_statuses) {
				list($_title, $_status) = explode(":", $_statuses);
				$status['status'][$_title] = $_status;
			}
		}
		return $status;
	}

	public static function getCallbackFailures($apiAuth = null) {
		$url = self::getBaseUrl(self::name()) ."/getCallbackFailures";
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, null);
		return array('callbackFailures' => (int)$response);
	}
}