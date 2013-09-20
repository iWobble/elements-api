<?php

namespace Elements;

class BulkJob extends AbstractApiHandler {
	
	public static function findBulkJob($id, $params = null, $apiAuth = null) {
		$params['id'] = $id;
		return self::retrieveCall($params, $apiAuth);
	}

	public static function upload($params = null, $apiAuth = null) {
		return self::postCall('upload', $params, $apiAuth);
	}

	public static function download($params = null, $apiAuth = null) {
		return self::postCall('download', $params, $apiAuth);
	}
}