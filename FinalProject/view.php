<?php
    
    session_start();


    $page = $_GET['page'];
    if (!$_SESSION['logged_in']) {
        if ($page == 0) {
            include("view/header.html");
            include("view/home.html");
        }
        if ($page == 1) {
            include("view/header.html");
            echo "<h2>User Created</h2>";
            include("view/home.html");
        }
        if ($page == 2) {
            include("view/header.html");
            include("view/createUser.html");
        }
        if ($page == 3) {
            include("view/header.html");
            include("view/login.html");
        }
    } else {
        require_once("controller.php");
        if ($page == 0) {
            include("view/logged_in_header.html");
            include("view/viewMotorcycles.html");
            displayMotorcycles();
        }
        if ($page == 1) {
            include("view/logged_in_header.html");
            include("view/createMotorcycle.html");
        }
        if ($page == 2) {
            $_SESSION['logged_in'] = false;
            include("controller.php");
        }
        if ($page == 3) {
            $motorcycle_id = $_GET['motorcycle'];
            updateMotorcycle($motorcycle_id);
        }
        if ($page == 4) {
            $motorcycle_id = $_GET['motorcycle'];
            deleteMotorcycle($motorcycle_id);
        }
    }
?>