<?php
/**
 * @file
 * Contains \Drupal\citi_bike\Controller\CitiBikeController.
 */

namespace Drupal\citi_bike\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\block\BlockInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\citi_bike\CitiBikeInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Controller for Citi Bike.
 */
class CitiBikeController extends ControllerBase {

  /**
   * Citi Bike Feed Parser controller.
   *
   * @var Drupal\citi_bike\CitiBikeInterface
   */
  protected $citi_bike;

  /**
   * @param Drupal\citi_bike\CitiBikeInterface $citi_bike
   *   The controls of citi bike feed parser.
   */
  public function __construct(CitiBikeInterface $citi_bike) {
    $this->citi_bike = $citi_bike;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('citi_bike.controller')
    );
  }

  /**
   * Display stations
   *
   * @param \Drupal\block\BlockInterface $block
   * @return mixed
   */
  public function showStations() {
    return $this->getStations();
  }

  /**
   * get stations
   *
   * @param \Drupal\block\BlockInterface $block
   * @return \Zend\Diactoros\Response\JsonResponse
   *  A json object containing an html template and after id
   */
  public function getStations() {

    $station_filter = [
      'ids' => array (
                  'id' => '522'
                ),
      'names' => array (
                  'name' => 'Forsyth St & Broome St'
                ),
      'bikes' => '10',
    ];

    $response = $this->citi_bike->get();

    // Filter out the stations
    $filtered_content = $this->filterStations($response['stationBeanList'], $station_filter);

    $render = [
      '#theme' => 'citi_bike_stations',
      '#stations' => $filtered_content,
      '#attached' => array(
        'library' =>  array(
          'citi_bike/citi_bike',
        ),
      ),
    ];

    return $render;
  }

  /**
   * Get and return stations as JSON feed
   *
   * @param \Drupal\block\BlockInterface $block
   * @return \Zend\Diactoros\Response\JsonResponse
   *  A json object containing an html template and after id
   */
  public function jsonStations() {

    $station_filter = [
      'ids' => array (
                  'id' => '522'
                ),
      'names' => array (
                  'name' => 'Forsyth St & Broome St'
                ),
      'bikes' => '10',
    ];

    $response = $this->citi_bike->get();

    // Filter out the stations
    $filtered_content = $this->filterStations($response['stationBeanList'], $station_filter);

    $render = [
      '#theme' => 'citi_bike_stations',
      '#stations' => $filtered_content,
    ];

    $json_response['data']['content'] = \Drupal::service('renderer')->render($render);

    return new JsonResponse($json_response);
  }

  /**
   * Filter Citi Bike Feed to specify which stations to load or exclude
   *
   * @param $stations
   *    An array of stations from the Citi Bike Feed
   * @param array $station_ids
   *    Station IDs used to determine a whitelist or blacklist of stations from
   * @param bool $include
   *    A flag, that if true, includes all stations specified in $station_ids, otherwise
   *    it excludes all stations in $station_ids
   * @return array
   *    An array of filtered stations
   */
  protected function filterStations($stations, $station_filter = [], $include = TRUE) {

    // Get Stations with the specified IDs
    if (isset($station_filter['ids']) && !empty($station_filter['ids'])) {
      $include = (bool) $include;
      $stations_ids = array_filter($stations, function ($station) use ($station_filter, $include) {
        return $include === in_array($station['id'], $station_filter['ids']);
      });
    }

    // Get Stations with the specified names
    if (isset($station_filter['names']) && !empty($station_filter['names'])) {
      $include = (bool) $include;
      $stations_names = array_filter($stations, function ($station) use ($station_filter, $include) {
        return $include === in_array($station['stationName'], $station_filter['names']);
      });
    }

    // Get Stations with the specified number of availables bikes and date is greate than 
    if (isset($station_filter['bikes']) && ($station_filter['bikes'] != null)) {
      $include = (bool) $include;
      $stations_dates = array_filter($stations, function ($station) use ($station_filter, $include) {
        return $include === ($station['availableBikes'] >= $station_filter['bikes'] && (strtotime($station['lastCommunicationTime'])) > 0);
      });
    }

    $stations = array_unique(array_merge($stations_ids, $stations_names, $stations_dates), SORT_REGULAR);

    return $stations;
  }

}
