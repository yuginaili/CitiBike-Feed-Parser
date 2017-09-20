/**
 * @file citi_bike.js
 * The plugin that retrieves the information from the citi bike module.
 *
 * Drupal Core: 8.x
 *
 */
(function ($, Drupal, drupalSettings) {

  /**
   * Attach our blocks to the plugin within context
   * @type {{attach: Drupal.behaviors.citi_bike.attach}}
   */
  Drupal.behaviors.citi_bike = {
    attach: function (context, settings) {

      $('.citi-bike-container', context).once('citi-bike-init').each(function(){
        var delta = $(this).attr('id');
        $(this).citiBike(settings.citi_bike[delta]);
      });
    }
  };

  // Enable Strict Mode
  'use strict';

  /**
   * Unchanging vars
   */
  var path_prefix = drupalSettings.path.baseUrl + drupalSettings.path.pathPrefix;

  var isWebkit = false;
  if(navigator.userAgent.indexOf('AppleWebKit') != -1) {
    isWebkit = true;
  }

  $.fn.citiBike = function(options) {
    var $this = $(this);
    var loading = false;

    /**
     * Elements
     */
    var $stationContainer = $('.citi-bike-stations-container', $this);
    var $stationLoader = $('.loading-icon', $this);

    // Display/Hide spinner
    var loadingIcon = function (show) {
      if (show) {
        var icon = '<div class="spinner">';
        icon += '<div class="rect1"></div>';
        icon += '<div class="rect2"></div>';
        icon += '<div class="rect3"></div>';
        icon += '<div class="rect4"></div>';
        icon += '<div class="rect5"></div>';
        icon += '</div>';

        $stationLoader.html(icon);
      }
      else {
        $stationLoader.html('');
      }
    };

    /**
     * Load stations
     */
    var loadStations = function() {

      $.ajax({
        url: path_prefix + 'citibike/block',
        dataType: 'json',
        success: function(response) {

          if (response.data != null && response.data.content != null) {    

            $stationContainer.append(response.data.content);
            
            loading = false;
            loadingIcon(false);

            $('#citi-bike-stations-container').DataTable();
          }
        }
      });
    };

    /**
     * Initialize the stations
     */
    var initCitiBike = function() {
      loading = false;
      $stationContainer.html('');

      loadingIcon(true);
      loadStations(null);
    };

    /**
     * Start it up!
     */
    initCitiBike();

  };

  // Add data Tables Plugin to the stations result table
  $(document).ready(function() {
    $('#citi-bike-stations-container').DataTable();
  } );

})(jQuery, Drupal, drupalSettings);
