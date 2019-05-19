<?php
        session_start();

        if (isset($_SESSION['usr_id'])!="") {
            header("Location: member.php");
        }

        include_once 'dbconnect.php';

        //check login
        if (isset($_POST['login'])) {
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $phone = mysqli_real_escape_string($con, $_POST['phone']);
            $sql = "SELECT * FROM users WHERE username = '" . $username. "' and phone = '" . $phone . "'";
            $result = mysqli_query($con, $sql);

            if ($row = mysqli_fetch_array($result)) {
                $_SESSION['usr_id'] = $row['id'];
                $_SESSION['usr_name'] = $row['username'];
                header("Location: member.php");
            } else {
                $_SESSION['errormsg'] = 'Username หรือเบอร์โทรศัพท์ไม่ถูกต้อง!!!';
                header("Location: index.php");
            }
        }
