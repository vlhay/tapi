<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

    
    $imageUrl = $_GET['url'];
    $endpoint = 'https://telegra.ph/upload';
    $postData = array(
        'file' => new CURLFile($imageUrl),
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
    $response = curl_exec($ch);
    curl_close($ch);

    $jsonData = json_decode($response, true);
    $imageUrl = $jsonData[0]['src'];
    $imageUrl = "https://telegra.ph".$imageUrl;
    


// Tạo một mảng chứa dữ liệu
$data = array(
    'image' => $imageUrl
);
// Thiết lập header để trả về JSON
header('Content-Type: application/json');
// Trả về dữ liệu dưới dạng JSON
echo json_encode($data);
