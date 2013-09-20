<?php

namespace Elements;

class ItemDetails extends AbstractApiHandler {

	public static function findItemDetailById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function findItemDetailByExternalId($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::getCall($params, $apiAuth);
	}

	public static function addItemDetail($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}

	public static function updateItemDetail($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl();
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function getItemDetails($params = null, $apiAuth = null) {
		return self::getCall('itemDetails', $params, $apiAuth);
	}

	public static function getItemDetailsByAttributes($params = null, $apiAuth = null) {
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

	public static function findItemDetailAttributeMap($params = null, $apiAuth = null) {
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

	public static function findAllItemDetailAttributeMap($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/attributeMap';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function addItemDetailAttributeMap($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/attributeMap';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('post', $url, $params); 
		return self::processResponse($response);	
	}

	public static function updateItemDetailAttributeMap($params = null, $apiAuth = null) {
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

	public static function deleteItemDetailAttributeMap($params = null, $apiAuth = null) {
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