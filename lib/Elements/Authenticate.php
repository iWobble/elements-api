<?php

namespace Elements;

class Authenticate extends AbstractApiHandler {

	public static function authenticate($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}
}