<?php
error_reporting(1);
//TIME define
date_default_timezone_set("Asia/Bangkok");
define("TIMESTAMP",time());
$TIMESTAMP = time();
define("GMTTIME",date('Y-m-d H:i:s'));
$GMTTIME = date('Y-m-d H:i:s');

define("DB_HOST","localhost");
define("DB_NAME","movie");
define("DB_USERNAME","test");
define("DB_PASSWORD","1234");

define("DB_PREFIX","tb_");
?>
