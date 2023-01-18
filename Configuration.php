<?php

/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DynamicDeviceDetectorCache;

use Piwik\Config;

class Configuration
{
    const KEY_CacheTTLInSeconds = 'cache_ttl_in_seconds';
    const DEFAULT_CacheTTLInSeconds = 300;

    public function install()
    {
        $config = $this->getConfig();

        if (empty($config->DynamicDeviceDetectorCache)) {
            $config->DynamicDeviceDetectorCache = [];
        }

        $cache = $config->DynamicDeviceDetectorCache;

        // we make sure to set a value only if none has been configured yet, eg in common config.
        if (empty($cache[self::KEY_CacheTTLInSeconds])) {
            $cache[self::KEY_CacheTTLInSeconds] = self::DEFAULT_CacheTTLInSeconds;
        }

        $config->DynamicDeviceDetectorCache = $cache;

        $config->forceSave();
    }

    public function uninstall()
    {
        $config                      = $this->getConfig();
        $config->DynamicDeviceDetectorCache = [];
        $config->forceSave();
    }

    /**
     * @return int
     */
    public function getCacheTTLInSeconds()
    {
        return $this->getConfigValue(self::KEY_CacheTTLInSeconds, self::DEFAULT_CacheTTLInSeconds);
    }

    private function getConfig()
    {
        return Config::getInstance();
    }

    private function getConfigValue($name, $default)
    {
        $config      = $this->getConfig();
        $attribution = $config->DynamicDeviceDetectorCache;
        if (isset($attribution[$name])) {
            return $attribution[$name];
        }
        return $default;
    }
}
