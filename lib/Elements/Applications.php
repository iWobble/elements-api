<?php

namespace Elements;

class Applications extends AbstractApiHandler {

	public static function getApplications($params = null, $apiAuth = null) {
		$base = self::name();
		return self::getCall($base, $params, $apiAuth);
	}
}