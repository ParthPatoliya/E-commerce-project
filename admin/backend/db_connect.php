<?php

$servername = 'localhost';
$username = 'root';

$dbname = 'skumar';

$conn = new mysqli($servername,$username,'',$dbname);


if(!$conn){
    die("not connect");
}
//echo"connected";

?>