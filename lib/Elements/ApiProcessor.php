<?php

namespace Elements;

class ApiProcessor extends Object {

	public function request($method, $url, $params) {
		return $this->_requestRaw($method, $url, $params);
	}

	public static function encode($array, $prefix = null) {
		if (!is_array($array)) {
			return $array;
		}

		$result = array();
		foreach ($array as $key => $value) {
			if (is_null($value)) {
				continue;
			}
			if ($prefix && $key && !is_int($key)) {
				$key = $prefix."[" . $key ."]";
			} elseif ($prefix) {
				$key = $prefix."[]";
			}

			if (is_array($value)) {
				$result[] = self::encode($value, $key, true);
			} else {
				$result[] = urlencode($key) ."=".urlencode($value);
			}
		}
		return implode('&', $result);
	}

	private function _requestRaw($method, $url, $params) {

		$headers = array();

		return $this->_curlRequest($method, $url, $headers, $params);

	}

	private function _curlRequest($method, $url, $headers, $params) {
		$curl = curl_init();
		$method = strtolower($method);
		$options = array();

		if ($method == 'get') {
			$options[CURLOPT_HTTPGET] = 1;
			if (count($params) > 0) {
				$encoded = self::encode($params);
				$url = "$url?$encoded";
			}
		} elseif ($method == 'post') {

		} elseif ($method == 'delete') {

		} elseif ($method == 'put') {

		}

		$opts[CURLOPT_URL] = $url;
    	$opts[CURLOPT_RETURNTRANSFER] = true;
    	$opts[CURLOPT_CONNECTTIMEOUT] = 30;
    	$opts[CURLOPT_TIMEOUT] = 80;
    	$opts[CURLOPT_RETURNTRANSFER] = true;
    	$opts[CURLOPT_HTTPHEADER] = $headers;
    	#if (!Stripe::$verifySslCerts)
      		$opts[CURLOPT_SSL_VERIFYPEER] = false;
		#}

      	curl_setopt_array($curl, $opts);
    	$content = curl_exec($curl);

        $errno = curl_errno($curl);

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    	curl_close($curl);

		return array($content, $code);
	}
}

class Object {


}