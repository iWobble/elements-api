<?php

namespace Elements;

class ApplicationFamily extends AbstractApiHandler {

	public static function getApplicationFamily($params = null, $apiAuth = null) {
		$base = self::name();
		return self::getCall($base, $params, $apiAuth);
	}

	public static function updateApplicationFamily($params = null, $apiAuth = null) {
		$base = self::name();
		return self::putCall($base, $params, $apiAuth);
	}

	public static function addCallbackUrl($params = null, $apiAuth = null) {
		return self::postCall('applicationFamily/v2CallbackURL', $params, $apiAuth);
	}

	public static function deleteCallbackUrl($params = null, $apiAuth = null) {
		return self::deleteCall('applicationFamily/v2CallbackURL', $params, $apiAuth);
	}
}
