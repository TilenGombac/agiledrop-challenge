<?php

namespace Drupal\agiledrop_challenge\Service;

/**
 * Class EventCountdownService
 */

class EventCountdownService {
    /**
     * EventCountdownService constructor.
     */
    public function __construct() {
        
    }

    public function getDaysUntil($dateUTC) {
        $diff = strtotime($dateUTC) - time();

        return round($diff / (60 * 60 * 24));
    }
}