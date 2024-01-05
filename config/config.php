<?php

return [
    \Piwik\DeviceDetector\DeviceDetectorFactory::class
        => Piwik\DI::autowire(\Piwik\Plugins\DynamicDeviceDetectorCache\Factory::class),
];
