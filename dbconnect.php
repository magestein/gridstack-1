<?php
/**
 * Created by PhpStorm.
 * User: user-pc
 * Date: 7/21/2015
 * Time: 10:32 AM
 */
$dbname = 'gridstack';
$dbuser = 'root';
$dbpass = '';
$dbhost = 'localhost';

mysql_connect( $dbhost, $dbuser, $dbpass ) or die('Error connecting to mysql: '.mysql_error());
mysql_select_db( $dbname );