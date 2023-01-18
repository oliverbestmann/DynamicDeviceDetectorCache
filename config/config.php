<?php

return [
    \Piwik\DeviceDetector\DeviceDetectorFactory::class
        => DI\autowire(\Piwik\Plugins\DynamicDeviceDetectorCache\Factory::class),
];
