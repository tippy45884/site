<?php

function connectToDB()
{
    require "config.php";
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "</p>");
        return null;
    }
    $conn->query("SET NAMES 'utf8'");
    ini_set('default_charset','utf-8');
    header('Content-type: text/html; charset=utf-8');
    mysql_set_charset('utf8');
    return $conn;
}

function userLogin($ur, $psw)
{
    $conn = connectToDB();
    $sql = "SELECT * FROM users WHERE username='$ur' AND password='$psw'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return array(true, $result->fetch_assoc());
    } else {
        $sql = "SELECT * FROM users WHERE email='$ur' AND password='$psw'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
        return array(true, $result->fetch_assoc());
        } else {
            return array(false, $conn->error);
        }
    }
}

function checkUserNameVailed($username){
    $conn = connectToDB();
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //username EXISTS
        return false;
    } else {
        return true;
    }
}
function checkEmailVailed($email){
    $conn = connectToDB();
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //email EXISTS
        return false;
    } else {
        return true;
    }

}

function addUserToDB($ur, $psw, $email)
{
    $conn = connectToDB();
    $sql = "INSERT INTO users(username, password, email) SELECT * FROM (SELECT '$ur', '$psw', '$email') AS tmp WHERE NOT EXISTS (SELECT username FROM users WHERE username='$ur') LIMIT 1;";

    if ($conn->query($sql) === true) {
        return array(true, null);
    } else {
        return array(false, $conn->error);
    }
}

function getProductWithID($id)
{
    $conn = connectToDB();
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return array(true, $results_array);
    } else {
        return array(false, $conn->error);
    }
}
function getProductWithName($name)
{
    $conn = connectToDB();
    $sql = "SELECT * FROM products WHERE name=$name";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return array(true, $results_array);
    } else {
        return array(false, $conn->error);
    }
}
function getTypeList()
{
    $conn = connectToDB();
    $sql = "SELECT * FROM types";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return array(true, $results_array);
    } else {
        return array(false, $conn->error);
    }
}
function getProductWithType($type)
{
    $conn = connectToDB();
    $sql = "SELECT * FROM products WHERE type=$type";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return array(true, $results_array);
    } else {
        return array(false, $conn->error);
    }
}
function getTop10Product($type)
{
    $conn = connectToDB();
    $sql = "SELECT * FROM products WHERE type=$type ORDER BY rank ASC LIMIT 10";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return array(true, $results_array);
    } else {
        return array(false, $conn->error);
    }
}
function addProduct($name, $type, $count, $onair, $description)
{
    $conn = connectToDB();
    $sql = "INSERT INTO products(name, type, count, onair_date, description,score,rank) VALUES ('$name', '$type', '$count','$onair','$description',null,null)";

    if ($conn->query($sql) === true) {
        return array(true, null);
    } else {
        return array(false, $conn->error);
    }
}

function getTop10News()
{
    $conn = connectToDB();
    $sql = "SELECT * FROM news ORDER BY date DESC LIMIT 10";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return array(true, $results_array);
    } else {
        return array(false, $conn->error);
    }
}
function addNews($title, $content, $url)
{
    $conn = connectToDB();
    $sql = "INSERT INTO news(title, content, url) VALUES ('$title', '$content', '$url')";

    if ($conn->query($sql) === true) {
        return array(true, null);
    } else {
        return array(false, $conn->error);
    }
}

function getProgress($user_id,$product_id){
    $conn = connectToDB();
    $sql = "SELECT * FROM progress WHERE user_id=$user_id AND product_id=$product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return array(true, $results_array);
    } else {
        return array(false, $conn->error);
    }
}

function addProgress($user_id,$product_id,$progress,$status){
    $conn = connectToDB();
    $sql = "INSERT INTO progress(user_id, product_id, progress, status) VALUES ('$user_id', '$product_id', '$progress', '$status')";

    if ($conn->query($sql) === true) {
        return array(true, null);
    } else {
        return array(false, $conn->error);
    }
}
function setProgress($user_id,$product_id,$progress,$status){
    $conn = connectToDB();
    $sql = "UPDATE progress SET progress='$progress', status='$status' WHERE user_id=$user_id AND product_id=$product_id";

    if ($conn->query($sql) === true) {
        return array(true, null);
    } else {
        return array(false, $conn->error);
    }
}

function getUserProduct($user_id,$type_id){
    $conn = connectToDB();
    $sql = "SELECT * FROM progress AS p1 INNER JOIN products AS p2 ON p1.product_id=p2.id WHERE p1.user_id=$user_id AND p2.type=$type_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return array(true, $results_array);
    } else {
        return array(false, $conn->error);
    }
}

function search($type_id, $keyword){

}