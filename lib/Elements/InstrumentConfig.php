<?php

namespace Elements;


class InstrumentConfig extends AbstractApiHandler {

	public static function getInstrumentConfigs($params = null, $apiAuth = null) {
		return self::getCall('instrumentConfigs', $params, $apiAuth);
	}

	public static function getInstrumentConfigCountries($params = null, $apiAuth = null) {
		return self::getCall('instrumentConfigs/countries', $params, $apiAuth);
	}

	public static function getInstrumentConfigAllowedCountries($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl() . '/countries';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);
	}
}