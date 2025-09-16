<?php

/**
 * GPlusMedia Inc.
 * This source file is subject to the BSD license that is bundled
 * with this package in the file LICENSE.txt.
 */

declare(strict_types=1);

namespace BrowscapPHPTest;

use Psr\SimpleCache\CacheInterface;

/**
 * Class TestCache
 */
class TestCache implements CacheInterface
{
    private array $cache;

    public function get($key, $default = null)
    {
        return $this->cache[$key] ?? $default;
    }

    public function set($key, $value, $ttl = null)
    {
        $this->cache[$key] = $value;
        return true;
    }

    public function delete($key)
    {
        unset($this->cache[$key]);
    }

    public function clear()
    {
        $this->cache = [];
    }

    public function getMultiple($keys, $default = null)
    {
        // NOOP
    }

    public function setMultiple($values, $ttl = null)
    {
        // NOOP
    }

    public function deleteMultiple($keys)
    {
        // NOOP
    }

    public function has($key)
    {
        return isset($this->cache[$key]);
    }
}
