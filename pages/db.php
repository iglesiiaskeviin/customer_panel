<!-- ADD HERE YOUR DB CONNECTIONS -->
<?php

$server = 'localhost'; /* server host */
$username = 'root'; /* db username(default: root) */
$password = ''; /* user db password */
$database = 'customer_panel'; /* your db name */

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>