<?php
header('Content-Type: application/json');
if (isset($_GET['count'])) {
    $type=$_GET['count'];
    $files='.ws/count.json';
    if (!file_exists($files)) {
        $initial=array('guest' => 0, 'like' => 0);
        file_put_contents($files, json_encode($initial));
    }
    $data=json_decode(file_get_contents($files), true);
    if ($type === 'guest') {
        $data['guest']++;
    } elseif ($type === 'like') {
        $data['like']++;
    } else {
        $response=array(
            'status' => 'error',
            'message' => 'Invalid parameter'
        );
        echo json_encode($response);
        exit;
    }
    file_put_contents($files, json_encode($data));
    $response=array(
        'status' => 'success',
        'count' => $data[$type]
    );
} else {
    $response=array(
        'status' => 'error',
        'message' => 'Invalid parameter'
    );
}
echo json_encode($response);