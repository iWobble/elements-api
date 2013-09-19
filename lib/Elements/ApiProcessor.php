<?php

namespace Elements;

class ApiProcessor {

	private function _requestRaw($meth, $url, $params) {

	}

	private function _curlRequest($method, $url, $headers, $params) {
		$curl = curl_init();
		$method = strtolower($meth);


	}

}