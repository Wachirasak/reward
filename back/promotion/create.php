<?php session_start();

include_once '../../dbconnect.php';

$title = "จัดการ Users";

require '../../library/core.php';
require '../../template/back/header.php';

$error = false;
if (isset($_POST['submit'])) {
        mysqli_query($con, "INSERT INTO promotion(detail,code) VALUES('".$_POST['promotion_detail']."','".$_POST['promotion_code']."')");
       }


?>
<div class="container-fluid">
  <h2 class="mt-1">เพิ่มโปรโมชัน</h2>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 card card-body bg-light" style="margin-top:20px; margin-left:20px;">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="addpromotion">
				<fieldset>
					<div class="form-group">
						<label for="name" class="font-weight-bold">รายละเอียดโปรโมชัน</label>
						<input type="text" name="promotion_detail" placeholder="รายละเอียดโปรโมชัน" required  class="form-control" />
					</div>

         <div class="form-group">
          <label for="name" class="font-weight-bold">รหัส</label>
          <input type="text" name="promotion_code" placeholder="รหัส" required  class="form-control" />
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
window.location.href = 'index.php';
  }
</script>

<?php
require '../../template/back/footer.php';
?>
