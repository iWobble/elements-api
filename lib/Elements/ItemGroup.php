<?php

namespace Elements;

class ItemGroup extends AbstractApiHandler {

	public static function findItemGroupById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function findItemGroupByExternalId($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::getCall($params, $apiAuth);
	}

	public static function addItemGroup($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}

	public static function updateItemGroupById($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function addItemsToItemGroup($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/items';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('post', $url, $params); 
		return self::processResponse($response);	
	}

	public static function removeItemFromItemGroup($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/items';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('delete', $url, $params); 
		return self::processResponse($response);	
	}

	public static function getLocalizedItemGroup($params = null, $apiAuth = null) {
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

	public static function addLocalizedItemGroup($params = null, $apiAuth = null) {
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

	public static function deleteLocalizedItemGroup($params = null, $apiAuth = null) {
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
}