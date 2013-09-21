<?php

namespace Elements;

class Store extends AbstractApiHandler {

	public static function findGoodsForStore($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/goods';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function findItemInStoreById($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->itemId) {
			throw new ElementsException(sprintf('Could not create URL for %s. No itemId found for object', $class));
		}
		$url = $instance->getInstanceUrl(). '/goods/item/'.$instance->itemId;
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function findItemInStoreByExternalId($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/goods/item';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function findItemGroupInStoreById($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->itemGroupId) {
			throw new ElementsException(sprintf('Could not create URL for %s. No itemId found for object', $class));
		}
		$url = $instance->getInstanceUrl(). '/goods/itemGroup/'.$instance->itemGroupId;
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);
	}

	public static function findItemGroupInStoreByExternalId($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/goods/itemGroup';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function findStores($params = null, $apiAuth = null) {
		return self::getCall('stores', $params, $apiAuth);
	}

	public static function findAvailableItemTypesInStore($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = '/stores/itemTypes';
		if ($instance->language) {
			$url .= '/' . $instance->language;
		}
		if ($instance->country) {
			$url .= '/' . $instance->country;
		}
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);
	}

	public static function findHotSellersInStore($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/hotSellers';
		if ($instance->language) {
			$url .= '/' . $instance->language;
		}
		if ($instance->country) {
			$url .= '/' . $instance->country;
		}
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);
	}
	
}