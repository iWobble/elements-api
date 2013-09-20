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

	public static function getItemGroups($params = null, $apiAuth = null) {
		return self::getCall('itemDetails', $params, $apiAuth);
	}

	public static function getItemGroupsByAttributes($params = null, $apiAuth = null) {
		$base = self::name();
		return self::getCall($base, $params, $apiAuth);
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

	public static function findAllLocalization($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/l10n';
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

	public static function findItemGroupAttributeMap($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->attributeMapId) {
			throw new ElementsException(sprintf('Could not create URL for %s. No Attribute Map ID found for object', $class));
		}
		$url = $instance->getInstanceUrl(). '/attributeMap/' . $instance->attributeMapId;
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function findAllItemGroupAttributeMap($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/attributeMap';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function addItemGroupAttributeMap($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/attributeMap';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('post', $url, $params); 
		return self::processResponse($response);	
	}

	public static function updateItemGroupAttributeMap($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->attributeMapId) {
			throw new ElementsException(sprintf('Could not create URL for %s. No Attribute Map ID found for object', $class));
		}
		$url = $instance->getInstanceUrl(). '/attributeMap/' . $instance->attributeMapId;
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);	
	}

	public static function deleteItemGroupAttributeMap($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->attributeMapId) {
			throw new ElementsException(sprintf('Could not create URL for %s. No Attribute Map ID found for object', $class));
		}
		$url = $instance->getInstanceUrl(). '/attributeMap/' . $instance->attributeMapId;
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('delete', $url, $params); 
		return self::processResponse($response);	
	}

}