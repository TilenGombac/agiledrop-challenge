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
        $now   = new \DateTime(gmdate('c', time()));
        $event = new \DateTime(date('c', strtotime($dateUTC)));

        $diff = $now->diff($event)->days;

        // If dates are less than 12 hours apart, diff will return 0,
        // even though the days may (still) be different
        if($diff == 0 && $now->format('d') !== $event->format('d')) {
            $diff = 1;
        }

        // DateTime diff returns absolute
        if($now > $event) {
            $diff *= -1;
        }

        return $diff;
    }
}