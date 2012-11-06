<?php

class SparkAPI_MemcachedCache implements SparkAPI_CacheInterface {
	protected $cache = null;
	
	protected $host = null;
	protected $port = null;
	
	
	function __construct($host = 'localhost', $port = 11211) {
		$this->host = $host;
		$this->port = $port;
		$this->cache = new Memcached;
		if (is_array($host)) {
			foreach ($host as $h) {
				$this->cache->addServer($h, $port);
			}
		}
		else {
			$this->cache->addServer($host, $port);
		}
	}

	function get($key) {
		$value = $this->cache->get($key);
		if ($value !== false) {
			return $value;
		}
		return null;
	}

	function set($key, $value, $expire) {
		return $this->cache->set($key, $value, time() + $expire);
	}


}
