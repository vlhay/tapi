<?php
$currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$path = parse_url($currentURL, PHP_URL_PATH);
$paths = explode('/', trim($path, '/'));
if (isset($_GET['id'])){ $video = $_GET['id'] ;} elseif (isset($paths[0])) { $video = $paths[0];} else { $video = '14620';}

$url = 'https://javtiful.com/ajax/get_cdn';
$data = http_build_query(array(
    'video_id' => $video,
));

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => $data
    )
);
$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
//header('Content-Type: application/json');
$data = json_decode($response, true);




?>
<input value="<?php echo urlencode($data['playlists']); ?>" />


