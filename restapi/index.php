<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *, Authorization');
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header('Content-type: json/application');
require 'connect.php';
require 'functions.php';

$method = $_SERVER['REQUEST_METHOD'];

$q = $_GET['q'];
$params = explode('/', $q);

$type = $params[0];
$id = $params[1];

switch ($method) {
    case 'GET':
        if ($type === 'tasks'){
            if (isset($id)){
                getTask($connect, $id);
            } else{
                getTasks($connect);
            }
        }
        if ($type === 'tags'){
            if (isset($id)){
                getTag($connect, $id);
            } else{
                getTags($connect);
            }
        }
        break;
    case 'POST':
        if ($type === 'tasks'){
            addTask($connect, $_POST);
        }
        if ($type === 'tags'){
            addTag($connect, $_POST);
        }
        break;
    case 'PATCH':
        if ($type === 'tasks'){
           if (isset($id)){

           }
        }
        break;
    case 'DELETE':
        if ($type === 'tasks'){
            if (isset($id)){
                deleteTask($connect, $id);
            }
        }
        if ($type === 'tags'){
            if (isset($id)){
                deleteTag($connect, $id);
            }
        }
        break;
}



