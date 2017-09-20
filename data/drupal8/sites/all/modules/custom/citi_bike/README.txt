
CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Features
 * Requirements
 * Setup
 * Installation


INTRODUCTION
------------

 * Developer: Yugi Naili <yugi.naili@gmail.com>

 * Citi Bike module parse the Citi Bike Feed and display
   the stations in a block and page in a sortable table using DataTables.


FEATURES
--------
 * Include/Exclude Stations
 * Limit Stations
 * Station Name
 * Available Docks
 * Available Bikes
 * Last Time Checked


REQUIREMENTS
------------

This module requires the following modules:
 
 * Block module
 * Jquery (https://www.drupal.org/project/jquery_update)
 * DataTables (https://github.com/DataTables/DataTables)


SETUP
-----
 
 * The default Citi Bike feed URL is: https://feeds.citibikenyc.com/stations/stations.json
 * If you'd like to enter a different URL, navigate to http://drupal8.dev/admin/config/citi_bike
   or click on the configuration link in the modules page. Enter in the feed URL and click save configuration.
 

INSTALLATION
------------

 * Install as you would normally install a contributed Drupal module.
 * The Citi Bike Stations block is already set to be displayed on the Homepage.
 * Navigate to http://drupal8.dev/citibike/stations to see the results on its own page.
 * Wherever you display the block you should now see a list of Citi Bike Stations.

