<?php
include(dirname(__FILE__).'/unit.php');
//Initiate configuration object for test environment
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
//Create Database Manager which initiate Doctrine connection
new sfDatabaseManager($configuration);
//Load test data
Doctrine_Core::loadData(sfConfig::get('sf_test_dir').'/fixtures');
?>
