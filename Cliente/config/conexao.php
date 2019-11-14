<?php
$servidor = "localhost";
$usuario = "root";
$senha = "mysql";
$dbname = "projetomkt";


// Create connection
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>