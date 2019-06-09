<?php session_start();
    header('Content-type: application/json; charset=UTF-8');

    $response = array();
    include_once '../../dbconnect.php';
//delete
if (isset($_POST['id'])) {
    $sql = "DELETE FROM users WHERE id=" . $_POST['id'];
    if(mysqli_query($con, $sql)) {
      $response['status']  = 'success';
			$response['message'] = 'ลบรายการเรียบร้อยแล้ว ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'ไม่สามารถลบได้ ...';
		}
    echo json_encode($response);

}
?>
