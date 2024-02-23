<?php
$servername = "localhost";
$username = "heshan";
$password = "heshan1234";
$dbname = "book_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>