<?php session_start();
    header('Content-type: application/json; charset=UTF-8');

    $response = array();
    include_once '../../dbconnect.php';

    if (isset($_GET['oid']) && $_GET['id']=='4') {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $oid = mysqli_real_escape_string($con, $_GET['oid']);
    $sql = "UPDATE orders SET status = '".$id."' WHERE id = " . $oid;
          if (mysqli_query($con, $sql)) {
            $sql2 = "SELECT * FROM orders WHERE id = ". $oid;
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_array($result2);
            $total_point = $row2['total_point'];
            if (mysqli_query($con,"UPDATE users SET own_point = own_point+$total_point WHERE id = " . $row2['user_id'])) {
                if(mysqli_query($con, "INSERT INTO point_history(user_id,add_point,note,admin) VALUES('".$row2['user_id']."','".$total_point."','ยกเลิก รหัส $oid','".$_SESSION['admin_usrname']."')")){
                  mysqli_query($con, "UPDATE orders SET cancel_reason = '".$_GET['note']."' WHERE id = " . $oid);
                }
                $response['status']  = 'success';
                $response['message'] = 'ยกเลิกเรียบร้อยแล้ว ...';
            } else {
                $response['status']  = 'error';
                $response['message'] = 'ไม่สามารถยกเลิกได้ ...';
            }
            echo json_encode($response);
          }
    } elseif(isset($_GET['oid']) && $_GET['id']=='2') {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $oid = mysqli_real_escape_string($con, $_GET['oid']);
        $sql = "UPDATE orders SET status = '".$id."' WHERE id = " . $oid;
            if(mysqli_query($con, $sql)) {
              mysqli_query($con, "UPDATE orders SET ems = '".$_GET['note']."' WHERE id = " . $oid);
              $response['status']  = 'success';
              $response['message'] = 'บันทึกเรียบร้อยแล้ว ...';
        } else {
              $response['status']  = 'error';
              $response['message'] = 'ไม่สามารถลบได้ ...';
        }
              echo json_encode($response);

    } elseif(isset($_GET['oid']) && $_GET['id']=='3') {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $oid = mysqli_real_escape_string($con, $_GET['oid']);
        $sql = "UPDATE orders SET status = '".$id."' WHERE id = " . $oid;
            if(mysqli_query($con, $sql)) {
              $response['status']  = 'success';
              $response['message'] = 'บันทึกเรียบร้อยแล้ว ...';
        } else {
              $response['status']  = 'error';
              $response['message'] = 'ไม่สามารถลบได้ ...';
        }
              echo json_encode($response);

    } else {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $oid = mysqli_real_escape_string($con, $_GET['oid']);
        $sql = "UPDATE orders SET status = '".$id."' WHERE id = " . $oid;
        mysqli_query($con, $sql);
        header("Location: index.php");
    }

    ?>
