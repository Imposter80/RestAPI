<?php

// ----- TASKS FUNCTIONS -----
function getTasks($connect){
    $tasks = mysqli_query($connect, "SELECT * FROM `tasks`");
    $tasksList = [];
    while ($task = mysqli_fetch_assoc($tasks)){
        $tasksList[] = $task;
    }
    echo json_encode($tasksList);
}
function getTask($connect, $id){
    $task = mysqli_query($connect, "SELECT tasks.id, tasks.name, tasks.description, tags.name as tName FROM tasks LEFT JOIN tasks_tags ON tasks_tags.taskId = tasks.id LEFT JOIN tags ON tags.id = tasks_tags.tagId WHERE tasks.id = '$id'");

    if (mysqli_num_rows($task) === 0){
        http_response_code(404);
        $res = [
            "status"=>false,
            "message" => "Task not found"
        ];
        echo json_encode($res);

    }else{
        if (mysqli_num_rows($task) > 1){
            $tasksList = [];
            while ($t = mysqli_fetch_assoc($task)){
                $tasksList[] = $t;
            }
            echo json_encode($tasksList);

        }else{

            $task = mysqli_fetch_assoc($task);
            echo json_encode($task);
        }
    }
}


function addTask($connect, $data){
    $name = $data['name'];
    $description=$data['description'];

    mysqli_query($connect, "INSERT INTO `tasks`(`name`, `description`) VALUES ('$name','$description')");

    http_response_code(201);
    $res = [
        "status"=> true,
        "id" => mysqli_insert_id($connect)
    ];
    echo json_encode($res);
}
function deleteTask($connect, $id){
    mysqli_query($connect, "DELETE FROM `tasks` WHERE `tasks`.`id` = '$id'");
    http_response_code(200);
    $res = [
        "status"=>true,
        "message" => "Task is deleted"
    ];
    echo json_encode($res);

}

// ----- TAGS FUNCTIONS -----

function getTags($connect){
    $tags = mysqli_query($connect, "SELECT * FROM `tags`");
    $tagsList = [];
    while ($tag = mysqli_fetch_assoc($tags)){
        $tagsList[] = $tag;
    }
    echo json_encode($tagsList);
}

function getTag($connect, $id){
    $tag = mysqli_query($connect, "SELECT tags.id, tags.name, tasks.name  as tName FROM tags LEFT JOIN tasks_tags ON tasks_tags.tagId = tags.id LEFT JOIN tasks ON tasks.id = tasks_tags.taskId WHERE tags.id = '$id'");
    if (mysqli_num_rows($tag) === 0){
        http_response_code(404);
        $res = [
            "status"=>false,
            "message" => "Tag not found"
        ];
        echo json_encode($res);

    }else{

        if (mysqli_num_rows($tag) > 1){
            $tagsList = [];
            while ($t = mysqli_fetch_assoc($tag)){
                $tagsList[] = $t;
            }
            echo json_encode($tagsList);

        }else{

            $tag = mysqli_fetch_assoc($tag);
            echo json_encode($tag);
        }


    }

}

function addTag($connect, $data){
    $name = $data['name'];
    mysqli_query($connect, "INSERT INTO `tags`(`name`) VALUES ('$name')");

    http_response_code(201);
    $res = [
        "status"=> true,
        "id" => mysqli_insert_id($connect)
    ];
    echo json_encode($res);
}
function deleteTag($connect, $id){
    mysqli_query($connect, "DELETE FROM `tags` WHERE `tags`.`id` = '$id'");
    http_response_code(200);
    $res = [
        "status"=>true,
        "message" => "Tag is deleted"
    ];
    echo json_encode($res);

}