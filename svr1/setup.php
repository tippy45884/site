<?php
require_once "config.php";

//connect to DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "</p>");
}
echo "Connected to DB successfully.</p>";



echo 'create database:</p>';

$db_name = DB_NAME;
$sql = "CREATE DATABASE $db_name";
if ($conn->query($sql) === true) {
    echo "Database created successfully.</p>";
} else {
    echo "Error creating database: " . $conn->error . "</p>";
}
echo 'Connect to Database ' . $db_name . ':</p>';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

mysql_set_charset('utf8');
ini_set('default_charset', 'utf-8');
header('Content-type: text/html; charset=utf-8');
$conn->query("SET NAMES 'utf8'");

echo 'Create users table:</p>';
$sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    password VARCHAR(300) NOT NULL,
    email VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if ($conn->query($sql) === true) {
    echo "Table users created successfully</p>";
} else {
    echo "Error creating users table: " . $conn->error . "</p>";
}

echo 'Create product table:</p>';
$sql = "CREATE TABLE products (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        type INT(10) NOT NULL,
        count INT(50),
        onair_day INT(50),
        score DOUBLE,
        rank INT(50),
        mod_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        description TEXT CHARACTER SET utf8 COLLATE utf8_general_ci,
        img_url ARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci
        )";

if ($conn->query($sql) === true) {
    echo "Table products created successfully</p>";
} else {
    echo "Error creating products table: " . $conn->error . "</p>";
}

echo 'Create types table:</p>';
$sql = "CREATE TABLE types (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        url VARCHAR(50) NOT NULL
        )";

if ($conn->query($sql) === true) {
    echo "Table types created successfully</p>";
} else {
    echo "Error creating types table: " . $conn->error . "</p>";
}

echo 'Insert default value to types table:</p>';
$sql = "INSERT IGNORE INTO types(id,name,url)  VALUES (0,'アニメ','anime'),(1,'漫画','comic'),(2,'音楽','music'),(3,'ドラマ','dorama')";

if ($conn->query($sql) === true) {
    echo "Insert default value to types successfully</p>";
} else {
    echo "Error to insert value to types: " . $conn->error . "</p>";
}

echo 'Create news table:</p>';
$sql = "CREATE TABLE news (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
            content TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
            date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            url VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci
            )";

if ($conn->query($sql) === true) {
    echo "Table news created successfully</p>";
} else {
    echo "Error when creating news table: " . $conn->error . "</p>";
}


echo 'Create progress table:</p>';
$sql = "CREATE TABLE progress (
        user_id INT(10) UNSIGNED KEY,
        product_id INT(10),
        progress INT(10),
        status INT(10)
        )";

if ($conn->query($sql) === true) {
    echo "Table progress created successfully</p>";
} else {
    echo "Error when creating progress table: " . $conn->error . "</p>";
}
