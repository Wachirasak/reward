<?php session_start();

include_once '../../dbconnect.php';

// fetch promotion
$sql = "SELECT * FROM promotion order by id";
$result = mysqli_query($con, $sql);

$title = "เพิ่มผู้ใช้";

require '../../library/core.php';
require '../../template/back/header.php';

$error = false;

if (isset($_POST['submit'])) {
        $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $own_point = mysqli_real_escape_string($con, $_POST['own_point']);
        $promotion = mysqli_real_escape_string($con, $_POST['promotion']);


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
        if (!preg_match("/^[0-9]+$/",$own_point)) {
          $error = true;
          $own_point_error = "กรุณาใส่แต้มแรกเข้าให้ถูกต้อง";
        }
        if (!$error) {
        if (mysqli_query($con, "INSERT INTO users(firstname,lastname,username,phone,own_point) VALUES('".$firstname."','".$lastname."',
          '".$username."','".$phone."','".$own_point."')"))
          {
          $sql2 = "SELECT max(id) as user_id FROM users";
          $result2 = mysqli_query($con,$sql2);
          $row2 = mysqli_fetch_array($result2);
          mysqli_query($con, "INSERT INTO point_history(user_id,add_point,promotion,note,admin) VALUES('".$row2['user_id']."','".$own_point."','".$promotion."','แต้มแรกเข้า','".$_SESSION['admin_usrname']."')");
           echo '<script type="text/javascript">';
           echo 'setTimeout(function () { swal();';
           echo '}, 100);</script>';
          } else {
          $errormsg = "ไม่สามารถเพิ่มได้ กรุณาลองใหม่อีกครั้ง";
            }
          }
       }


?>
<div class="container-fluid">
  <h2 class="mt-1">เพิ่มผู้ใช้</h2>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 card card-body bg-light" style="margin-top:20px; margin-left:20px;">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="adduserform">
				<fieldset>
					<div class="form-group">
						<label for="name" class="font-weight-bold">ชื่อ</label>
						<input type="text" name="firstname" placeholder="ชื่อ" required  class="form-control" value="<?php if($error) echo $firstname;?>" />
            <span class="text-danger"><?php if (isset($firstname_error)) echo $firstname_error; ?></span>
					</div>

         <div class="form-group">
          <label for="name" class="font-weight-bold">นามสกุล</label>
          <input type="text" name="lastname" placeholder="นามสกุล" required  class="form-control" value="<?php if($error) echo $lastname;?>"  />
          <span class="text-danger"><?php if (isset($lastname_error)) echo $lastname_error; ?></span>
        </div>

					<div class="form-group">
						<label for="name" class="font-weight-bold">Username</label>
						<input type="text" name="username" placeholder="Username" required class="form-control" value="<?php if($error) echo $lastname;?>" />
					</div>

					<div class="form-group">
						<label for="name" class="font-weight-bold">โทรศัพท์</label>
						<input type="text" name="phone" placeholder="โทรศัพท์" required class="form-control" value="<?php if($error) echo $phone;?>"  />
            <span class="text-danger"><?php if (isset($phone_error)) echo $phone_error; ?></span>
					</div>

          <div class="form-group">
            <label for="name" class="font-weight-bold">แต้มแรกเข้า</label>
            <input type="number" name="own_point" placeholder="แต้มแรกเข้า" class="form-control" value="<?php if($error) echo $own_point;?>"  />
            <span class="text-danger"><?php if (isset($own_point_error)) echo $own_point_error; ?></span>
          </div>

          <div class="form-group">
						<label for="name" class="font-weight-bold">โปรโมชัน</label>
            <select name="promotion" class="form-control input-sm">
                  <option value="">-</option>
                  <?php while($row = mysqli_fetch_array($result)) { ?>
                  <option value="<?php echo $row['detail']; ?>"><?php echo $row['detail']; ?></option>
                <?php } ?>
            </select>
					</div>

					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> บันทึก</button>
            <button type="button" name="cancle" class="btn btn-secondary btn-sm" onclick="back()"><i class="fas fa-times-circle"></i> ยกเลิก</button>
					</div>
				</fieldset>
			</form>
			<!--display message -->
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
</div>
<script>
function back() {
window.location.href = 'index.php';
  }
  function swal() {
    Swal.fire({
      title: 'เพิ่มผู้ใช้แล้ว',
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
