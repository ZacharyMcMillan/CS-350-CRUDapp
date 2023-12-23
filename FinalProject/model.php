<?php

    if (session_id() === "") {
        session_start();
    }
    function createUser($uname, $pword)
    {
        try {
            $dsn = "mysql:host=localhost;dbname=finalproject";
            $username = 'student';
            $password = 'cs350';
            
            $db = new PDO($dsn, $username, $password);

            $create = "INSERT INTO users (username, password)
                    VALUES('".$uname."', '".password_hash($pword, PASSWORD_DEFAULT)."');";

            $db->exec($create);

        } catch (PDOException $e) {
            echo "<ERROR> cannot connect to database";
        }
    }

    function getUserId()
    {
        try {
            $username = 'student';
            $password = 'cs350';
            
            $con = mysqli_connect("localhost", "$username", "$password", "finalproject");

            $query = "SELECT user_id FROM users WHERE username like '%".$_SESSION['username']."%'";

            $result = $con->query($query);
            $row = mysqli_fetch_assoc($result);

            return $row['user_id'];

        } catch (PDOException $e) {
            echo "<ERROR> cannot connect to database";
        }
    }

    function createMotorcycle($manufacturer, $model, $year, $engine)
    {
        try {
            $dsn = "mysql:host=localhost;dbname=finalproject";
            $username = 'student';
            $password = 'cs350';
            
            $db = new PDO($dsn, $username, $password);

            $create = "INSERT INTO motorcycles (user_id, manufacturer, model, year, engine)
                    VALUES(".getUserId().", '".$manufacturer."', '".$model."', ".$year.", ".$engine.");";

            $db->exec($create);

        } catch (PDOException $e) {
            echo "<ERROR> cannot connect to database";
        }
    }

    function getMotorcycles()
    {
        try {
            $username = 'student';
            $password = 'cs350';
            
            $con = mysqli_connect("localhost", "$username", "$password", "finalproject");

            $query = "SELECT * FROM motorcycles WHERE user_id = ".getUserId().";";

            return $con->query($query);

        } catch (PDOException $e) {
            echo "<ERROR> cannot connect to database";
        }
    }

    function getMotorcycle($motorcycleId)
    {
        try {
            $username = 'student';
            $password = 'cs350';
            
            $con = mysqli_connect("localhost", "$username", "$password", "finalproject");

            $query = "SELECT * FROM motorcycles WHERE motorcycle_id = $motorcycleId;";

            $result = $con->query($query);
            $row = mysqli_fetch_assoc($result);

            return $row;

        } catch (PDOException $e) {
            echo "<ERROR> cannot connect to database";
        }
    }

    function delMotorcycle($motorcycleId)
    {
        try {
            $dsn = "mysql:host=localhost;dbname=finalproject";
            $username = 'student';
            $password = 'cs350';
            
            $db = new PDO($dsn, $username, $password);

            $delete = "DELETE FROM motorcycles WHERE motorcycle_id = $motorcycleId;";

            $db->exec($delete);

        } catch (PDOException $e) {
            echo "<ERROR> cannot connect to database";
        }
    }

    function updMotorcycle($motorcycleId, $manufacturer, $model, $year, $engine)
    {
        try {
            $dsn = "mysql:host=localhost;dbname=finalproject";
            $username = 'student';
            $password = 'cs350';
            
            $db = new PDO($dsn, $username, $password);

            $update = "UPDATE motorcycles SET manufacturer = '$manufacturer', model = '$model', year = $year, engine = $engine
                        WHERE motorcycle_id = $motorcycleId;";

            $db->exec($update);

        } catch (PDOException $e) {
            echo "<ERROR> cannot connect to database";
        }
    }

    function loginUser($uname, $pword)
    {
        $username = 'student';
        $password = 'cs350';

        $con = mysqli_connect("localhost", "$username", "$password", "finalproject");
        $query = "SELECT password FROM users WHERE username like '%".$uname."%'";
        $result = $con->query($query);
        $row = mysqli_fetch_assoc($result);

        return password_verify($pword, $row['password']);
        
    }
?>