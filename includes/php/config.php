<?php
@session_start();
session_cache_expire(0);
error_reporting(E_ALL ^ E_NOTICE);

define('_hostName'  , 'localhost');	
define('_userName'  , 'binhlam_db');	
define('_dbName'    , 'binhlam_db');	
define('_pass'      , 'Binhlam123@');
//define('_userName'  , 'root');	
//define('_dbName'    , 'ototuan');	
//define('_pass'      , '');

$dir = dirname(__FILE__);
$dir = substr($dir,0,strrpos($dir,'\\')); 
define('_dirRootSite',($dir).'/');
define('_dirLib','./includes/lib06/');

define('myWeb','/');
define('myPath','../file/upload/');
define('webPath','/file/upload/');



include_once('mysql.php');
include_once("commonFunction.php");


global $db;
$db = new CDB_MySql();
$db->connect(_hostName,_userName,_pass);
$db->selectdb(_dbName);
mysql_query("SET NAMES utf8");

?>
