<?php

namespace Drupal\agiledrop_challenge\Plugin\Block;

use Drupal\Core\Block\Blockbase;


/**
 * Provides an Event Countdown block
 * 
 * @Block(
 *  id = "event_countdown_block",
 *  admin_label = @Translation("Event Countdown Block"),
 *  category = @Translation("Events")
 * )
 */
class EventCountdownBlock extends BlockBase {
    
    /**
     * {@inheritdoc}
     */
    public function build() {
        $node = \Drupal::routeMatch()->getParameter('node');
        $nid = $node->id();

        $node = \Drupal\node\Entity\Node::load($nid);

        $date = $node->get('field_date')->getString();

        $daysUntil = \Drupal::service('agiledrop_challenge.event_countdown_service')->getDaysUntil($date);

        $output = '';
        if($daysUntil == 0) {
            $output = 'This event is happening today';
        } elseif($daysUntil > 0) {
            $output = $daysUntil . ' days left until event starts';
        } else {
            $output = 'This event already passed.';
        }

        return [
            '#markup' => $output,
        ];
    }

    /**
     * The block should not be cached
     */
    public function getCacheMaxAge() {
        return 0;
    }
}