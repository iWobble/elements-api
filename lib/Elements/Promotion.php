<?php

namespace Elements;

class Promotion extends AbstractApiHandler {
	
	public static function addPromotion($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}

	public static function findPromotionById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function getPromotions($params = null, $apiAuth = null) {
		return self::getCall('promotions', $params, $apiAuth);
	}

	public static function getPromotionUserMembership($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->userId) {
			throw new ElementsException(sprintf('Could not create URL for %s. No userId found for object', $class));
		}
		$url = $instance->getInstanceUrl() . '/userMembership/' . $this->userId;
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);
	}

	public static function addPromotionUserMemebership($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->userId) {
			throw new ElementsException(sprintf('Could not create URL for %s. No userId found for object', $class));
		}
		$url = $instance->getInstanceUrl() . '/userMembership/' . $this->userId;
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);	
	}

	public static function deletePromotionUserMemebership($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->userId) {
			throw new ElementsException(sprintf('Could not create URL for %s. No userId found for object', $class));
		}
		$url = $instance->getInstanceUrl() . '/userMembership/' . $this->userId;
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('delete', $url, $params); 
		return self::processResponse($response);	
	}

	public static function getAllUsersQualifyForPromotion($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl() . '/users';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);
	}

	public static function findLocalizedPromotion($params = null, $apiAuth = null) {
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

	public static function addLocalizedPromotion($params = null, $apiAuth = null) {
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

	public static function addPromotionJob($params = null, $apiAuth = null) {
		return self::getCall('job/promotion', $params, $apiAuth);
	}
}