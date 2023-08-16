<?php
/* Host name of the MySQL server */
$host = 'localhost';
/* MySQL account username */
$user = 'root';
/* MySQL account password */
$passwd = '';
/* The schema you want to use */
$schema = 'userlitdb';
/* Connection with MySQLi, procedural-style */
$con = mysqli_connect($host, $user, $passwd, $schema);
/* Check if the connection succeeded */
if (!$con)
{
   echo 'Connection failed<br>';
   echo 'Error number: ' . mysqli_connect_errno() . '<br>';
   echo 'Error message: ' . mysqli_connect_error() . '<br>';
   die();
}
echo 'Successfully connected!<br>';