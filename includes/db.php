<?php
$db['db_host']='localhost';
$db['db_username']='root';
$db['db_password']='';
$db['db_name']='cms-v2';

foreach($db as $key=>$value){
    define(strtoupper($key),$value);
}

$conn=mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

