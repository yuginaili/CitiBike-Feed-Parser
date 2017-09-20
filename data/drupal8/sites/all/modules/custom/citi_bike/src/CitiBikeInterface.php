<?php
/**
 * @file
 * Contains \Drupal\citi_bike\CitiBikeInterface.
 */

namespace Drupal\citi_bike;

/**
 * CitiBikeInterface.
 */
interface CitiBikeInterface {

  /**
   * Get response data.
   */
  public function get($call_path = '', $parameters = array());

}
