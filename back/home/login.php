<?php
        session_start();

        if (isset($_SESSION['admin_id'])!="") {
            header("Location: index.php");
        }

        include_once '../../dbconnect.php';

        //check login
        if (isset($_POST['login'])) {
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $sql = "SELECT * FROM admin WHERE username = '" . $username. "' and password = '" . md5($password) . "'";
            $result = mysqli_query($con, $sql);

            if ($row = mysqli_fetch_array($result)) {
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_usrname'] = $row['username'];
                header("Location: index.php");
            } else {
                $_SESSION['errormsg'] = 'Username หรือรหัสผ่านไม่ถูกต้อง!!!';
                header("Location: admin_login.php");
            }
        }
