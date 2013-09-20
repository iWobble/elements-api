<?php

namespace Elements;

class ApiProcessor  {

	private $defaults = array(
		'partnerId' => null,
		'accessKey' => null,
		'appFamilyId' => null,
		'secretKey' => null,
	);

	private $options = array();

	public function __construct($options = null) {
		if (!is_array($options)) {
			$options = array($options);
		}
		$this->options = array_merge($this->defaults, $options);
	}

	public static function apiUrl($url = '') {
		$version = \Elements::VERSION;
		$baseUrl = \Elements::getBaseUrl();
		return "$baseUrl/tfel2rs/$version/" . $url;
	}

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
		if (!is_array($params)) {
			$params = array($params);
		}

		$headers = array();
		if (isset($this->options['partnerId'])) {
			$partnerId = $this->options['partnerId'];
		} else {
			$partnerId = \Elements::getPartnerId();
		}

		if (isset($this->options['appFamilyId'])) {
			$appFamilyId = $this->options['appFamilyId'];
		} else {
			$appFamilyId = \Elements::getAppFamilyId();
		}

		if (isset($this->options['accessKey'])) {
			$accessKey = $this->options['accessKey'];
		} else {
			$accessKey = \Elements::getAccessKey();
		}

		$secretKey = false;
		if (isset($this->options['secretKey'])) {
			$secretKey = $this->options['secretKey'];
		}

		$signature = false;
		if (($partnerId && $appFamilyId) && !$accessKey) {
			if (\Elements::$useSignatureAuth && isset(\Elements::$signature)) {
				$signature = \Elements::$signature;
			} elseif (\Elements::$useSignatureAuth && $secretKey !== false) {
				$signature = \Elements::generateSignature($secretKey, $partnerId, $appFamilyId);
			}
		}

		if (!$partnerId && !$appFamilyId) {
			throw new ElementsException('No PartnerID or AppFamilyId.');
		}

		if (!$signature && !$accessKey) {
			throw new ElementsException('Need accessKey or signature for authentication');
		}

		$params['auth.partnerId'] = $partnerId;
		$params['auth.appFamilyId'] = $appFamilyId;
		if ($signature !== false) {
			$params['auth.signature'] = $signature;
		} else {
			$params['auth.accessKey'] = $accessKey;
		}

		list($response, $code) = $this->_curlRequest($method, $url, $headers, $params);
		return array($response, $code);
	}

	private function _curlRequest($method, $url, $headers, $params) {
		$curl = curl_init();
		$method = strtolower($method);
		$options = array();

		$url = self::apiUrl($url);
		if ($method == 'get') {
			$options[CURLOPT_HTTPGET] = 1;
			if (count($params) > 0) {
				$encoded = self::encode($params);
				$url = "$url?$encoded";
			}
		} elseif ($method == 'post' || $method == 'put') {
			$options[CURLOPT_POST] = 1;
			$options[CURLOPT_POSTFIELDS] = self::encode($params);
		} elseif ($method == 'delete') {
			$options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
			if (count($params) > 0) {
				$encoded = self::encode($params);
				$url = "$url?$encoded";
			}

		} else {
			throw new ElementsException('Unrecognized method %method');
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

        if ($content == false) {
 			$errno = curl_errno($curl);
 			$message = curl_error($curl);
 			curl_close($curl);
 			$this->handleCurlError($errno, $message);
        }



        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    	curl_close($curl);
		return array($content, $code);
	}

	public function handleCurlError($errno, $message) {
		switch ($errno) {
			case CURLE_COULDNT_CONNECT:
			case CURLE_COULDNT_RESOLVE_HOST:
    		case CURLE_OPERATION_TIMEOUTED:
    			$message = sprintf('Could not connect to "%s". Please check network connectivitiy and try again', \Elements::getBaseUrl());
    			break;
    		case CURLE_SSL_CACERT:
 			case CURLE_SSL_PEER_CERTIFICATE:
    			$message = 'Could not verify SSL Certificiate. Please check your settings and try again.';
    			break;
    		default:
    			$message = "Unexpected error sending request. Please try again.";
		}

		$message .= "\n\nNetwork Error [errno: $errno]: $message";
		throw new ElementsException($message);
	}
}

