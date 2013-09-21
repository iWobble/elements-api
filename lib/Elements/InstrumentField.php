<?php

namespace Elements;


class InstrumentField extends AbstractApiHandler {

	public static function getInstrumentFields($params = null, $apiAuth = null) {
		return self::getCall('instrumentFields', $params, $apiAuth);
	}
}