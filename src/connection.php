<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$serverName='localhost';
$userName='root';
$password='';
$baseName='gameshop';

$conn=new mysqli($serverName, 
        $userName,$password, $baseName);

if($conn->connect_error){
    die('Error. You are not properly'
            . ' connected to DB:'.$conn->connect_error);
   
}
$conn->set_charset("utf8");
echo 'You are connected to DB<br>';



