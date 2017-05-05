<?php

//JSON格式
function setJson($status,$message,$data = Array()){

    $result['status'] = $status;
    $result['message'] = $message;
    $result['data'] = $data;

    die(json_encode($result));
}