<?php

namespace Piwik\Plugins\DynamicDeviceDetectorCache;

use DeviceDetector\DeviceDetector;

class SerializableDeviceDetector extends DeviceDetector
{
    public function __construct(DeviceDetector $detector)
    {
        parent::__construct($detector->userAgent, $detector->clientHints);

        $this->clientHints = $detector->clientHints;
        $this->bot = $detector->bot;
        $this->client = $detector->client;
        $this->device = $detector->device;
        $this->os = $detector->os;
        $this->brand = $detector->brand;
        $this->model = $detector->model;
    }
}
