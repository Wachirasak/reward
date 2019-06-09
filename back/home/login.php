<?php   session_start();
require("botdetect.php");


        if (isset($_SESSION['admin_id'])!="") {
            header("Location: index.php");
        }

        include_once '../../dbconnect.php';

        //check login
        if (isset($_POST['login'])) {
            $ExampleCaptcha = new Captcha("ExampleCaptcha");
            // validate the Captcha to check we're not dealing with a bot
            $isHuman = $ExampleCaptcha->Validate();

            if (!$isHuman) {
              $_SESSION['errormsg'] = 'กรุณากรอกข้อมูลที่ปรากฎให้ถูกต้อง';
              header("Location: admin_login.php");
            } else {
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


        }
