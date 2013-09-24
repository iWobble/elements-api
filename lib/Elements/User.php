<?php

namespace Elements;

class User extends AbstractApiHandler {

	public static function addUser($params = null, $apiAuth = null) {
		return self::postCall('user', $params, $apiAuth);
	}

	public static function findUserById($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function findUserByExternalKey($id, $params = null, $apiAuth = null) {
		$base = self::name();
		$params['externalKey'] = $id;
		return self::getCall($base, $params, $apiAuth);
	}

	public static function updateUserById($id, $params = null, $apiAuth = null) {
		$parmas['id'] = $id;
		
		// $instance = new $class($params);
		// $url = $instance->getInstanceUrl();
		// $processor = new ApiProcessor($apiAuth);
		// list($response, $code) = $processor->request('put', $url, $params); 
		// return self::processResponse($response);
	}

	public static function updateUserByExternalKey($id, $params = null, $apiAuth = null) {
		$params['externalKey'] = $id;
		$url = self::getBaseUrl(self::name());
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function setUserProperty($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/properties';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);	
	}

	public static function addUserTag($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/tags';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);
	}

	public static function deleteUserTag($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/tags';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('delete', $url, $params); 
		return self::processResponse($response);	
	}

	public static function findUserEmail($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/emailAddresses';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function addUserEmail($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/emailAddress';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('post', $url, $params); 
		return self::processResponse($response);	
	}

	public static function updateUserEmail($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->emailId) {
			throw new ElementsException(sprintf('Could not create URL for %s. No emailId found for object', $class));
		}
		$url = $instance->getInstanceUrl(). '/emailAddress/'.$instance->emailId;
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('put', $url, $params); 
		return self::processResponse($response);	
	}

	public static function deleteUserEmail($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		if (!$instance->emailId) {
			throw new ElementsException(sprintf('Could not create URL for %s. No emailId found for object', $class));
		}
		$url = $instance->getInstanceUrl(). '/emailAddress/'.$instance->emailId;
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('delete', $url, $params); 
		return self::processResponse($response);
	}

	public static function getUsers($params = null, $apiAuth = null) {
		return self::getCall('users', $params, $apiAuth);
	}

	public static function getFinancialSummaries($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/financialSummaries';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);
	}

	public static function getItemInstances($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/itemInstances';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);
	}

	public static function getRecommendations($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/recommendations';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function getRestrictions($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/restrictions';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function createSecureKey($params = null, $apiAuth = null) {
		return self::postCall('user/secureKey', $params, $apiAuth);
	}

	public static function blockUser($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/block';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('post', $url, $params); 
		return self::processResponse($response);	
	}

	public static function getBlock($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/block';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('get', $url, $params); 
		return self::processResponse($response);	
	}

	public static function unblockUser($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/block';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('delete', $url, $params); 
		return self::processResponse($response);	
	}

	public static function setUserLoginTimeById($params = null, $apiAuth = null) {
		$class = self::className();
		$instance = new $class($params);
		$url = $instance->getInstanceUrl(). '/login';
		$processor = new ApiProcessor($apiAuth);
		list($response, $code) = $processor->request('post', $url, $params); 
		return self::processResponse($response);	
	}

	public static function setUserLoginTimeByExternalKey($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall('user/login', $params, $apiAuth);	
	}
}
