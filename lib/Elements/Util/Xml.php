<?php

namespace Elements\Util;

class Xml {

	public static function build($input, $options = array()) {
		if (!is_array($options)) {
			$options = array('return' => (string)$options);
		}
		$defaults = array(
			'return' => 'simplexml'
		);
		$options = array_merge($defaults, $options);

		if (is_array($input) || is_object($input)) {
			return self::fromArray((array)$input, $options);
		} elseif (strpos($input, '<') !== false) {
			if ($options['return'] === 'simplexml' || $options['return'] === 'simplexmlelement') {
				return new \SimpleXMLElement($input, LIBXML_NOCDATA);
			}
			$dom = new \DOMDocument();
			$dom->loadXML($input);
			return $dom;
		} elseif (file_exists($input) || strpos($input, 'http://') === 0 || strpos($input, 'https://') === 0) {
			if ($options['return'] === 'simplexml' || $options['return'] === 'simplexmlelement') {
				return new \SimpleXMLElement($input, LIBXML_NOCDATA, true);
			}
			$dom = new \DOMDocument();
			$dom->load($input);
			return $dom;
		} elseif (!is_string($input)) {
			throw new XmlException('Invalid Input');
		}
		throw new XmlException('XML cannot be read');
	}

	public static function fromArray($input, $options = array()) {
		if (!is_array($input) || count($input) !== 1) {
			throw new XmlException('Invalid Input');
		}
		$key = key($input);
		if (is_integer($key)) {
			throw new XmlException('The key of input must be alphanumeric');
		}

		if (!is_array($options)) {
			$options = array('format' => (string)$options);
		}
		$defaults = array(
			'format' => 'tags',
			'version' => '1.0',
			'encoding' => 'UTF-8',
			'return' => 'simplexml'
		);
		$options = array_merge($defaults, $options);

		$dom = new \DOMDocument($options['version'], $options['encoding']);
		self::_fromArray($dom, $dom, $input, $options['format']);

		$options['return'] = strtolower($options['return']);
		if ($options['return'] === 'simplexml' || $options['return'] === 'simplexmlelement') {
			return new \SimpleXMLElement($dom->saveXML());
		}
		return $dom;
	}

	protected static function _fromArray($dom, $node, &$data, $format) {
		if (empty($data) || !is_array($data)) {
			return;
		}
		foreach ($data as $key => $value) {
			if (is_string($key)) {
				if (!is_array($value)) {
					if (is_bool($value)) {
						$value = (int)$value;
					} elseif ($value === null) {
						$value = '';
					}
					$isNamespace = strpos($key, 'xmlns:');
					if ($isNamespace !== false) {
						$node->setAttributeNS('http://www.w3.org/2000/xmlns/', $key, $value);
						continue;
					}
					if ($key[0] !== '@' && $format === 'tags') {
						$child = null;
						if (!is_numeric($value)) {
							// Escape special characters
							// http://www.w3.org/TR/REC-xml/#syntax
							// https://bugs.php.net/bug.php?id=36795
							$child = $dom->createElement($key, '');
							$child->appendChild(new \DOMText($value));
						} else {
							$child = $dom->createElement($key, $value);
						}
						$node->appendChild($child);
					} else {
						if ($key[0] === '@') {
							$key = substr($key, 1);
						}
						$attribute = $dom->createAttribute($key);
						$attribute->appendChild($dom->createTextNode($value));
						$node->appendChild($attribute);
					}
				} else {
					if ($key[0] === '@') {
						throw new XmlException('Invalid array');
					}
					if (is_numeric(implode('', array_keys($value)))) { // List
						foreach ($value as $item) {
							$itemData = compact('dom', 'node', 'key', 'format');
							$itemData['value'] = $item;
							self::_createChild($itemData);
						}
					} else { // Struct
						self::_createChild(compact('dom', 'node', 'key', 'value', 'format'));
					}
				}
			} else {
				throw new XmlException('Invalid array');
			}
		}
	}

	protected static function _createChild($data) {
		extract($data);
		$childNS = $childValue = null;
		if (is_array($value)) {
			if (isset($value['@'])) {
				$childValue = (string)$value['@'];
				unset($value['@']);
			}
			if (isset($value['xmlns:'])) {
				$childNS = $value['xmlns:'];
				unset($value['xmlns:']);
			}
		} elseif (!empty($value) || $value === 0) {
			$childValue = (string)$value;
		}

		if ($childValue) {
			$child = $dom->createElement($key, $childValue);
		} else {
			$child = $dom->createElement($key);
		}
		if ($childNS) {
			$child->setAttribute('xmlns', $childNS);
		}

		self::_fromArray($dom, $child, $value, $format);
		$node->appendChild($child);
	}

	public static function toArray($obj) {
		if ($obj instanceof \DOMNode) {
			$obj = simplexml_import_dom($obj);
		}
		if (!($obj instanceof \SimpleXMLElement)) {
			throw new XmlException('The input is not instance of SimpleXMLElement, DOMDocument or DOMNode.');
		}
		$result = array();
		$namespaces = array_merge(array('' => ''), $obj->getNamespaces(true));
		self::_toArray($obj, $result, '', array_keys($namespaces));
		return $result;
	}

	protected static function _toArray($xml, &$parentData, $ns, $namespaces) {
		$data = array();

		foreach ($namespaces as $namespace) {
			foreach ($xml->attributes($namespace, true) as $key => $value) {
				if (!empty($namespace)) {
					$key = $namespace . ':' . $key;
				}
				$data['@' . $key] = (string)$value;
			}

			foreach ($xml->children($namespace, true) as $child) {
				self::_toArray($child, $data, $namespace, $namespaces);
			}
		}

		$asString = trim((string)$xml);
		if (empty($data)) {
			$data = $asString;
		} elseif (!empty($asString)) {
			$data['@'] = $asString;
		}

		if (!empty($ns)) {
			$ns .= ':';
		}
		$name = $ns . $xml->getName();
		if (isset($parentData[$name])) {
			if (!is_array($parentData[$name]) || !isset($parentData[$name][0])) {
				$parentData[$name] = array($parentData[$name]);
			}
			$parentData[$name][] = $data;
		} else {
			$parentData[$name] = $data;
		}
	}
}