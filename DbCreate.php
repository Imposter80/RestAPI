<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "test_list_tasks";

//-------------- create a database --------------
try {
     $conn = new PDO("mysql:host=$serverName", $userName, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create DB
     $sql = "CREATE DATABASE $dbName CHARACTER SET utf8 COLLATE utf8_general_ci";

     $conn->exec($sql);
     echo "Database created successfully <br>";
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
}
$conn = null;



//-------------- create table tasks --------------
try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table tasks
    $sql = "CREATE TABLE tasks (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL, 
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
  update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
  )";

    $conn->exec($sql);
    echo "Tasks table created successfully <br>";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

//-------------- create table tags --------------
try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table tags
    $sql = "CREATE TABLE tags (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,  
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
  update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
  )";

    $conn->exec($sql);
    echo "Tags table created successfully <br>";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

//-------------- create table tasks_tags --------------
try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table tasks_tags
    $sql = "CREATE TABLE tasks_tags (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    taskId INT(6) NOT NULL,
    tagId INT(6) NOT NULL,
    create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
  )";

    $conn->exec($sql);
    echo "Tasks_tags table created successfully <br>";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}



//-------------- filling the database --------------
try {
    // sql to insert table tasks
    $sql = "INSERT INTO tasks (name, description) VALUES                                                            
    ('First task', 'Make a test task'),
    ('Second task', 'Check test task'),
    ('Third task', 'Upload test task to GitHub'),
    ('Fourth task', 'Send link to test task')
    ";

    $conn->exec($sql);
    echo "All records created successfully <br>";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


try {
    // sql to insert table tags
    $sql = "INSERT INTO tags (name) VALUES                                                            
    ('PHP'),
    ('GitHub'),
    ('Upload'),
    ('Send')
    ";

    $conn->exec($sql);
    echo "All records created successfully <br>";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

try {
    // sql to insert table tasks_tags
    $sql = "INSERT INTO tasks_tags (taskId, tagId) VALUES                                                            
    ('1', '1'),
    ('2', '1'),
    ('2', '2'),
    ('3', '1'),
    ('3', '2'),
    ('3', '3'),
    ('4', '2'),
    ('4', '3'),
    ('4', '4')                               
    ";

    $conn->exec($sql);
    echo "All records created successfully <br>";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


$conn = null;

?>