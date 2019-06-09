<?php session_start();

include_once '../../dbconnect.php';

$error = false;

if (isset($_GET['id'])) {
$id = mysqli_real_escape_string($con, $_GET['id']);
$sql = "SELECT * FROM users WHERE id = " . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
}

if (isset($_POST['submit'])) {

        $id = mysqli_real_escape_string($con, $_POST['id']);
        $minus= mysqli_real_escape_string($con, $_POST['minus']);
        $own_point = mysqli_real_escape_string($con, $_POST['own_point']);

        if (!preg_match("/^[0-9]+$/",$minus)) {
          $error = true;
          $minus_error = "กรุณาใส่ตัวเลขให้ถูกต้อง";
        }

        if (!$error) {
        if (mysqli_query($con, "UPDATE users SET own_point = own_point-$minus WHERE id = " . $id)){
          mysqli_query($con, "INSERT INTO point_history(user_id,minus_point,note,admin) VALUES('".$id."','".$minus."','".$_POST['note']."','".$_SESSION['admin_usrname']."')");
          //$successmsg = "ลดแต้มเรียบร้อยแล้ว <a href='index.php'>กลับ</a>";
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal();';
          echo '}, 100);</script>';
          //header("Location: index.php#".$id);
          } else {
          $errormsg = "ไม่สามารถแก้ไขได้ กรุณาลองใหม่อีกครั้ง";
            }
          }
       }

$title = "แก้ไขแต้ม";

require '../../library/core.php';
require '../../template/back/header.php';

$error = false;

?>
<div class="container-fluid">
  <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="frmMain">
    <div class="row">
      <div class="col-lg-4" style="margin-top:20px; margin-left:20px;">
        <ul class="list-group">
                      <li class="list-group-item"><strong>ชื่อ-นามสกุล</strong> : <?php if(isset($row['firstname'])) { echo $row['firstname']; } else { echo $_POST['firstname']; } ?>
                          <?php if(isset($row['lastname'])) { echo $row['lastname']; } else { echo $_POST['lastname']; } ?></li>
                      <li class="list-group-item"><strong>ยูสเซอร์เนม / Username</strong> : <?php if(isset($row['username'])) { echo $row['username']; } else { echo $_POST['username']; } ?></li>
                      <li class="list-group-item"><strong>แต้มที่มี</strong> : <?php if(isset($row['own_point'])) { echo $row['own_point']; } else { echo $_POST['own_point']-$minus; } ?></li>
                  </ul>
      </div>
    </div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 card card-body bg-light" style="margin-top:20px; margin-left:20px;">
				<fieldset>
					<div class="form-group">
            <input type="hidden" name="id" value="<?php if(isset($row['id'])) { echo $row['id']; } else { echo $_POST['id']; } ?>" />
            <input type="hidden" name="firstname" value="<?php if(isset($row['firstname'])) { echo $row['firstname']; } else { echo $_POST['firstname']; } ?>" />
            <input type="hidden" name="lastname" value="<?php if(isset($row['lastname'])) { echo $row['lastname']; } else { echo $_POST['lastname']; } ?>" />
            <input type="hidden" name="username" value="<?php if(isset($row['username'])) { echo $row['username']; } else { echo $_POST['username']; } ?>" />
            <input type="hidden" name="own_point" value="<?php if(isset($row['own_point'])) { echo $row['own_point']; } else { echo $_POST['own_point']-$minus; } ?>" />
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text">ลด</span>
            </div>
            <input type="number" name="minus" class="form-control minus" placeholder="" min="1" value="1">
            <span class="text-danger"><?php if (isset($minus_error)) echo $minus_error; ?></span>
          </div>

          <div class="form-group">
           <label for="name" class="font-weight-bold">หมายเหตุ</label>
           <input type="text" name="note" placeholder="หมายเหตุ" required class="form-control"/>
         </div>

					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> บันทึก</button>
            <button type="button" name="cancle" class="btn btn-secondary btn-sm" onclick="back()"><i class="fas fa-times-circle"></i> ยกเลิก</button>
					</div>
				</fieldset>
			</form>
			<!--3.display message -->
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
</div>
<script>

function back() {
window.location.href = '../index.php';
  }

  function swal() {
    Swal.fire({
      title: 'ลดแต้มเรียบร้อยแล้ว',
      type: 'success',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'ยืนยัน',
      allowOutsideClick: false
    }).then(function() {
    // Redirect the user
    window.location.href = "index.php";
    });
  }
</script>
<?php
require '../../template/back/footer.php';
?>
