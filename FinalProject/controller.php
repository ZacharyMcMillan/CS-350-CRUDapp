<?php

    if (session_id() === "") {
        session_start();
        // $_SESSION['logged_in'] = false;
    }
    $_SESSION['start'] = false;
    $_SESSION['username'];

    require_once("model.php");

    if ($_SESSION['logged_in'] == null) {
        if (isset($_POST['create_Username']) && isset($_POST['create_Password'])) {
            createUser($_POST['create_Username'], $_POST['create_Password']);
            header("Location: view.php?page=1");
        } elseif (isset($_POST['login_Uname']) && isset($_POST['login_Pword'])) {
            if (loginUser($_POST['login_Uname'], $_POST['login_Pword'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $_POST['login_Uname'];
                header("Location: view.php?page=0");
            } else {
                $_SESSION['logged_in'] = false;
                header("Location: view.php?page=0");
            }
        } else {
            header("Location: view.php?page=0");
        }
    } else {
        if (isset($_POST['manufacturer']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['engine'])) {
            createMotorcycle($_POST['manufacturer'], $_POST['model'], $_POST['year'], $_POST['engine']);
            header("Location: view.php?page=0");
        } elseif (isset($_POST['updateManufacturer']) && isset($_POST['updateModel']) && isset($_POST['updateYear']) && isset($_POST['updateEngine'])) {
            updMotorcycle($_POST['motorcycleId'], $_POST['updateManufacturer'], $_POST['updateModel'], $_POST['updateYear'], $_POST['updateEngine']);
            header("Location: view.php?page=0");
        }
    }

    if (!$_SESSION['start']) {
        function displayMotorcycles()
        {
            echo "<table>";
            echo "<th>ID</th>";
            echo "<th>Manufacturer</th>";
            echo "<th>Model</th>";
            echo "<th>Year</th>";
            echo "<th>Engine</th>";
            if ($result = getMotorcycles()) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['motorcycle_id']}</td>";
                    echo "<td>{$row['manufacturer']}</td>";
                    echo "<td>{$row['model']}</td>";
                    echo "<td>{$row['year']}</td>";
                    echo "<td>{$row['engine']}</td>";
                    echo "<td><a href='view.php?page=3&motorcycle={$row['motorcycle_id']}'>update</a></td>";
                    echo "<td><a href='view.php?page=4&motorcycle={$row['motorcycle_id']}'>delete</a></td>";
                    echo "</tr>";
                }
                $result->free();
            }
            echo "</table>";
        }

        function deleteMotorcycle($motorcycleId)
        {
            delMotorcycle($motorcycleId);
            header("Location: view.php?page=0");
        }

        function updateMotorcycle($motorcycleId)
        {
            $row = getMotorcycle($motorcycleId);

            echo "<form action='controller.php' method='POST'>";
            echo "<input type='hidden' name='motorcycleId' value='$motorcycleId'>";
            echo "<label>Manufacturer: </label>";
            echo "<input type='text' name='updateManufacturer' id='updateManufacturer' value='{$row['manufacturer']}' required>";
            echo "<br>";

            echo "<label>Model: </label>";
            echo "<input type='text' name='updateModel' id='updateModel' value='{$row['model']}' required>";
            echo "<br>";

            echo "<label>Year: </label>";
            echo "<input type='number' name='updateYear' id='updateYear' value='{$row['year']}' required>";
            echo "<br>";

            echo "<label>Engine: </label>";
            echo "<input type='number' name='updateEngine' id='updateEngine' value='{$row['engine']}' required>";
            echo "<br>";
            echo "<br>";

            echo "<hr width='90%'>";

            echo "<br>";
            echo "<input type='submit' value='Submit'>";
            echo "<br>";
            echo "</form>";
        }

        $_SESSION['start'] = true;
    }
?>