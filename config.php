<?php

//connect database ด้วย PDO

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = 'online_shop';
    
    $dns = "mysql:host=$host;dbname=$database;charset=utf8";

        try {
            $conn = new PDO($dns, $username, $password);
            // ตั้งค่าโหมดการแสดง error
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           // echo "PDO: Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

?>