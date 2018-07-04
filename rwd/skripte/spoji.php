<?php



$user= 'root' ;
$pass= '';
$db= 'nova';

$dbc= new mysqli('localhost', $user, $pass, $db) or die("nije se moguće spojitit") ;
 echo "spojeni ste na bazu!!!!";

