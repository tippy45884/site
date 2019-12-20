<?php

function conServer($path, $post_data)
{
    require_once "config.php";
    


    $curl = curl_init();
    $url = 'http://' . HOST . '/' . $path;

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    ini_set('default_charset','utf-8');
    header('Content-type: text/html; charset=utf-8');
    if ($post_data != null) {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        //curl_setopt($curl,CURLOPT_POST,count($post_data));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    } else {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    }

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    /*r
    esponse is including post_data,
    don't know why yet,
    using regex to get JSON out from string.
     */
    $pattern = '/\{(?:[^{}]|(?R))*\}/x';
    preg_match_all($pattern, $response, $matches);
    //echo $matches[0][0];

    curl_close($curl);
    return json_decode($matches[0][0], false);
}
