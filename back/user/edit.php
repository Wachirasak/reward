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

        $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $id = mysqli_real_escape_string($con, $_POST['id']);

        if (!preg_match("/^[a-zA-Zก-๙-]+$/",$firstname)) {
          $error = true;
          $firstname_error = "กรุณาใส่ชื่อให้ถูกต้อง";
        }
        if (!preg_match("/^[a-zA-Zก-๙-]+$/",$lastname)) {
          $error = true;
          $lastname_error = "กรุณาใส่นามสกุลให้ถูกต้อง";
        }
        if (!preg_match("/^[0-9]+$/",$phone)) {
          $error = true;
          $phone_error = "กรุณาใส่เบอร์โทรศัพท์ให้ถูกต้อง";
        }
        if (!$error) {
        if (mysqli_query($con, "UPDATE users SET firstname = '".$firstname."', lastname = '".$lastname."' , username = '".$username."' ,
        phone = '".$phone."' WHERE id = " . $id)){
          //$successmsg = "แก้ไขผู้ใช้เรียบร้อยแล้ว <a href='index.php'>กลับ</a>";
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal();';
          echo '}, 100);</script>';
          } else {
          $errormsg = "ไม่สามารถแก้ไขได้ กรุณาลองใหม่อีกครั้ง";
            }
          }
       }

$title = "แก้ไขผู้ใช้";

require '../../library/core.php';
require '../../template/back/header.php';

$error = false;

?>
<div class="container-fluid">
  <h2 class="mt-1">แก้ไขผู้ใช้ </h2>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 card card-body bg-light" style="margin-top:20px; margin-left:20px;">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="editproductform">
				<fieldset>
					<div class="form-group">
            <input type="hidden" name="id" value="<?php if(isset($row['id'])) { echo $row['id']; } else { echo $_POST['id']; } ?>" />
						<label for="name" class="font-weight-bold">ชื่อ</label>
						<input type="text" name="firstname" placeholder="ชื่อ" required value="<?php if(isset($row['firstname'])) { echo $row['firstname']; } else { echo $_POST['firstname']; } ?>"  class="form-control" />
            <span class="text-danger"><?php if (isset($firstname_error)) echo $firstname_error; ?></span>
          </div>

          <div class="form-group">
           <label for="name" class="font-weight-bold">นามสกุล</label>
           <input type="text" name="lastname" placeholder="นามสกุล" required value="<?php if(isset($row['lastname'])) { echo $row['lastname']; } else { echo $_POST['lastname']; } ?>" class="form-control" />
           <span class="text-danger"><?php if (isset($lastname_error)) echo $lastname_error; ?></span>
         </div>

         <div class="form-group">
          <label for="name" class="font-weight-bold">Username</label>
          <input type="text" name="username" placeholder="Username" required value="<?php if(isset($row['username'])) { echo $row['username']; } else { echo $_POST['username']; } ?>" class="form-control" />
          <span class="text-danger"><?php if (isset($username_error)) echo $point_error; ?></span>
        </div>

        <div class="form-group">
          <label for="name" class="font-weight-bold">โทรศัพท์</label>
          <input type="text" name="phone" placeholder="โทรศัพท์" required class="form-control" value="<?php if(isset($row['phone'])) { echo $row['phone']; } else { echo $_POST['phone']; } ?>"  />
          <span class="text-danger"><?php if (isset($phone_error)) echo $phone_error; ?></span>
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
      title: 'แก้ไขผู้ใช้เรียบร้อยแล้ว',
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
