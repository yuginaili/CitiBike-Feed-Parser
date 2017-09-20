<?php

/**
 * @file
 * Contains \Drupal\citi_bike\Plugin\Block\CitiBikeBlock.
 */

namespace Drupal\citi_bike\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a citi bike block block type.
 * @Block(
 *   id = "citi_bike",
 *   admin_label = @Translation("Citi Bike"),
 *   category = @Translation("Citi Bike"),
 * )
 */
class CitiBikeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $config = $this->getConfiguration();

    $form['feed_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Citi Bike Feed URL'),
      '#description' => $this->t('Enter the Citi Bike Feed URL to parse'),
      '#default_value' => isset($config['feed_url']) ? $config['feed_url'] : '',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['feed_url'] = $values['feed_url'];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    // Output the wrappers
    $content = [];
    $content['#attributes']['class'] = [
      'block',
      'block-citi-bike'
    ];

    $content[] = [
      '#theme_wrappers' => [
        'container' => [
          '#attributes' => [
            'class' => ['citi-bike-container'],
          ],
        ],
      ],
      'stations' => [
        '#markup' => '<div class="citi-bike-stations-container"></div>',
      ],
      'loading' => [
        '#markup' => '<div class="loading-icon"></div>',
      ],
    ];

    // Add the library and settings
    $content['#attached'] = [
      'library' => [
        'citi_bike/citi_bike',
      ],
      'drupalSettings' => [
        'citi_bike' => [
          'citi-bike-stations-container',
        ],
      ],
    ];

    return $content;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $default_config = \Drupal::config('citi_bike.settings');
    return array(
      'feed_url' => $default_config->get('feed_url'),
    );
  }

}
