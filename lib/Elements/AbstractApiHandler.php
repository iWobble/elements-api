<?php

namespace Elements;

abstract class AbstractApiHandler {

	public function getBaseUrl($base = null) {
		if (!$base) {
			throw new ElementsException('No name found for this Elements API call.');
		}
		return "https://sharapova.lgelements.com/tfel2rs/v2/" . strtolower($base);
	}

	private static function validate($method, $params=null, $apiKey=null) {
		if (isset($params) && !is_array($params)) {
			throw new ElementsException('You must pass an array as the first argument to the Elements API call');
		}
		if (isset($apiKey) && !is_string($apiKey)) {
			throw new ElementsException('');
		}
	}

	protected function postCall($class, $params = null, $apiKey = null) {
		self::validate('post', $params, $apiKey);
		$processor = new ApiProcessor($apiKey);
		$url = self::getBaseUrl($class);
		list($response, $code) = $processor->request('post', $url, $params);
		return Util\Xml::toArray($response);
	}

	protected function getCall($class, $params = null, $apiKey = null) {
		self::validate('get', $params, $apiKey);
		$processor = new ApiProcessor($apiKey);
		$url = self::getBaseUrl($class);
		list($response, $code) = $processor->request('get', $url, $params);
		$response = Util\Xml::build($response, 'simplexmlelement');
		return Util\Xml::toArray($response);
	}

	protected function deleteCall($class, $params = null, $apiKey = null) {
		self::validate('delete', $params, $apiKey);
		$processor = new ApiProcessor($apiKey);
		$url = self::getBaseUrl($class);
		list($response, $code) = $processor->request('delete', $url, $params);
		return Util\Xml::toArray($response);
	}

	protected function putCall($class, $params = null, $apiKey = null) {
		self::validate('put', $params, $apiKey);
		$processor = new ApiProcessor($apiKey);
		$url = self::getBaseUrl($class);
		list($response, $code) = $processor->request('put', $url, $params);
		return Util\Xml::toArray($response);
	}



}