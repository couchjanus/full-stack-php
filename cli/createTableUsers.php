<?php

$servername = "localhost";
$username = "dev";
$password = "ghbdtn";
$dbname = "mydb";

// Create TABLE users
$sql = "CREATE TABLE users (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    role_id int(11) UNSIGNED NOT NULL DEFAULT '0',
    status int(11) UNSIGNED NOT NULL DEFAULT '1',
    PRIMARY KEY (id)
);";

/* проверка соединения */
try {
    $connection = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
    echo "Connected successfully\n";
    $connection->query($sql);
    echo "Table Created successfully\n";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "\n";
    die();
} finally {
    // код, который будет выполнен при любом раскладе
    $connection = null;
}
?>
