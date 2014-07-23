<?php

namespace Elements;

class SubscriptionOffer extends AbstractApiHandler {

	public static function addSubscriptionOffer($params = null, $apiAuth = null) {
		$base = self::name();
		return self::postCall($base, $params, $apiAuth);
	}
			
}