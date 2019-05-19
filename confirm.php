<?php session_start();
        include_once 'dbconnect.php';


        if (isset($_SESSION['usr_id'])=="") {
            header("Location: index.php");
        }

        $user_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
				$phone = $_POST['phone'];
        $ins_username = $_POST['ins_username'];
        $lineid = $_POST['lineid'];
        $address = $_POST['address'];
        $district = $_POST['district'];
        $province = $_POST['province'];
        $zipcode = $_POST['zipcode'];
				$country = $_POST['country'];
        $total_point = $_POST['total_point'];

				$sql_order = "INSERT INTO orders(user_id,phone,ins_username,lineid,address,district,province,zipcode,country,total_point)
											VALUES('".$user_id."','".$phone."','".$ins_username."','".$lineid."','".$address."','".$district."','".$province."','".$zipcode."','".$country."','".$total_point."') ";
				$result_order = mysqli_query($con,$sql_order);
				$sql_order2 = "SELECT max(id) as order_id FROM orders WHERE user_id = ".$user_id;
				$result_order2 = mysqli_query($con,$sql_order2);
				$row2 = mysqli_fetch_array($result_order2);
				$order_id = $row2['order_id'];

				foreach($_SESSION['cart'] as $p_id=>$qty)
							{
								$sql3	= "SELECT * FROM products WHERE id=$p_id";
								$query3	= mysqli_query($con, $sql3);
								$row3	= mysqli_fetch_array($query3);
                $product_name = $row3['name'];
								$point	= $row3['point'];

								$sql4	= "INSERT INTO order_details(order_id,product_id,product_name,point,quantity) VALUES('".$order_id."', '".$p_id."', '".$product_name."', '".$point."', '".$qty."')";
								$result4	= mysqli_query($con, $sql4);
							}


				if ($result_order && $result4) {
					//update point
					$sql_updatepoint = "UPDATE users SET own_point = own_point-$total_point WHERE id = ".$user_id;
					$result_updatepoint = mysqli_query($con,$sql_updatepoint);
					$_SESSION['order_success'] = 'ทำรายการเรียบร้อยแล้ว <BR> กรุณารอแอดมินตรวจสอบข้อมูล';
					foreach($_SESSION['cart'] as $p_id)
							{
								unset($_SESSION['cart']);
							}
          header("Location: result.php");

				} else {
					$_SESSION['order_error'] = 'ไม่สามารถทำรายการได้ กรุณาตรวจสอบข้อมูลแล้วลองใหม่อีกครั้ง';
          header("Location: cart.php");
				}
				?>
