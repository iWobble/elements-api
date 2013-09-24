<?php

namespace Elements;

class Item extends AbstractApiHandler {

	public static function findItemById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function findItemByExternalKey($id, $params = null, $apiAuth = null) {
		$params['externalKey'] = $id;
		return self::getCall(self::name(), $params, $apiAuth);
	}

	public static function addItem($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}

	public static function updateItem($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function getItems($params = null, $apiAuth = null) {
		return self::getCall('items', $params, $apiAuth);
	}

	public static function findLocalization($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->language) {
			throw new ElementsException(sprintf('Could not create URL for %s. No language found for object', $class));
		}
		$url = $instance->getInstanceUrl(). '/l10n/'.$instance->language;
		if ($instance->country) {
			$url .= "/" . $instance->country;
		}
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function addLocalization($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->language) {
			throw new ElementsException(sprintf('Could not create URL for %s. No language found for object', $class));
		}
		$url = $instance->getInstanceUrl(). '/l10n/'.$instance->language;
		if ($instance->country) {
			$url .= "/" . $instance->country;
		}
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);	
	}

	public static function deleteLocalization($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->language) {
			throw new ElementsException(sprintf('Could not create URL for %s. No language found for object', $class));
		}
		$url = $instance->getInstanceUrl(). '/l10n/'.$instance->language;
		if ($instance->country) {
			$url .= "/" . $instance->country;
		}
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('delete', $url, $params); 
		return self::processResponse($response);	
	}

	public static function findItemRecommendations($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/recommendations';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

}