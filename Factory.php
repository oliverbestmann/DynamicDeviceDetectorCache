<?php

/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DynamicDeviceDetectorCache;

use Piwik\Cache;
use Piwik\Common;
use Piwik\DeviceDetector\DeviceDetectorFactory;
use Piwik\Version;

class Factory extends DeviceDetectorFactory
{
    private $config;

    public function __construct()
    {
        $this->config = new Configuration();
    }

    protected function getDeviceDetectionInfo($userAgent, array $clientHints = [])
    {
        $lazyCache = Cache::getLazyCache();

        $userAgent = self::getNormalizedUserAgent($userAgent, $clientHints);
        $cacheKey = "ua." . Version::VERSION . '.' . sha1($userAgent);

        // check if a compatible device detector is in lazy cache
        $serialized = $lazyCache->fetch($cacheKey);
        if ($serialized !== false) {
            // if we find a detector, deserialize it
            $cdd = Common::safe_unserialize($serialized, true);
            if (isset($cdd) && $cdd !== false) {
                return $cdd;
            }
        }

        // parse usr agent.
        $deviceDetector = parent::getDeviceDetectionInfo($userAgent, $clientHints);

        # remove parsers & caches from device detector
        # and serialize it into cache.
        $serialized = serialize(new SerializableDeviceDetector($deviceDetector));
        $lazyCache->save($cacheKey, $serialized, $this->config->getCacheTTLInSeconds());

        return $deviceDetector;
    }
}
