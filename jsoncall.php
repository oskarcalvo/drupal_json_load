<?php

/**
 * @file
 * Handles incoming requests to fire off regularly-scheduled tasks (cron jobs).
 */

/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
//We only need the database options to works, son load it from bootstrap
drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE);

//No we can use drupal db query  http://drupal.org/node/310075
$query = db_select('users', 'u');
$query->condition('u.uid', 0, '<>');
$query->fields('u', array('uid', 'name', 'status', 'created', 'access'));
$query->range(0, 50);
$result = $query->execute();
$record = $result->fetchObject();

//echo "<br>";
//print_r(microtime(true));
print json_encode($record);
exit;
