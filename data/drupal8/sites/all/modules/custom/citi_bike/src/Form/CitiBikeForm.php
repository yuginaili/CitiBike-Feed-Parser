<?php
/**
 * @file
 * Contains \Drupal\citi_bike\Form\CitiBikeForm.
 */

namespace Drupal\citi_bike\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\citi_bike\CitiBikeInterface;

/**
 * Configure citi_bike settings for this site.
 */
class CitiBikeForm extends ConfigFormBase {

  /**
   * The Drupal configuration factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;
  /**
   * The Citi Bike controller.
   *
   * @var Drupal\citi_bike\CitiBikeInterface
   */
  protected $citi_bike;

  /**
   * @param Drupal\citi_bike\CitiBikeInterface $citi_bike
   *   The controls of citi bike.
   */
  public function __construct(ConfigFactoryInterface $config_factory, CitiBikeInterface $citi_bike) {
    $this->configFactory = $config_factory;
    $this->citi_bike = $citi_bike;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('citi_bike.controller')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'citi_bike_config_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['citi_bike.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get module configuration.
    $config = $this->config('citi_bike.settings')->get();

    $form['feed_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Citi Bike Feed URL'),
      '#default_value' => $config['feed_url'],
      '#required' => TRUE,
      '#description' => $this->t('The Citi Bike feed URL to parse.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Call Citi Bike and get an access token for the given app
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $feed_url = $form_state->getValue('feed_url');

    // Get module configuration.
    $this->config('citi_bike.settings')
      ->set('feed_url', $feed_url)
      ->save();

    parent::submitForm($form, $form_state);
  }

}
