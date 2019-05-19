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

        $add= mysqli_real_escape_string($con, $_POST['add']);
        $minus = mysqli_real_escape_string($con, $_POST['minus']);
        $own_point = mysqli_real_escape_string($con, $_POST['own_point']);

        if (!preg_match("/^[0-9]+$/",$add)) {
          $error = true;
          $add_error = "กรุณาใส่ตัวเลขให้ถูกต้อง";
        }
        if (!preg_match("/^[0-9]+$/",$minus)) {
          $error = true;
          $minus_error = "กรุณาใส่ตัวเลขให้ถูกต้อง";
        }

        if (!$error) {
        if (mysqli_query($con, "UPDATE users SET own_point = '".$own_point."', lastname = '".$lastname."' , username = '".$username."' ,
        phone = '".$phone."' WHERE id = " . $id)){
          $successmsg = "แก้ไขผู้ใช้เรียบร้อยแล้ว <a href='index.php'>กลับ</a>";
          } else {
          $errormsg = "ไม่สามารถแก้ไขได้ กรุณาลองใหม่อีกครั้ง";
            }
          }
       }

$title = "แก้ไขแต้ม";
require '../../template/back/header.php';

$error = false;

?>
<div class="container-fluid">
  <h4 class="mt-1">แต้มที่มี : <?php if(isset($row['own_point'])) { echo $row['own_point']; } else { echo $_POST['own_point']; } ?></h4>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 card card-body bg-light" style="margin-top:20px; margin-left:20px;">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="editproductform">
				<fieldset>
					<div class="form-group">
            <input type="hidden" name="id" value="<?php if(isset($row['id'])) { echo $row['id']; } else { echo $_POST['id']; } ?>" />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text">เพิ่ม</span>
            </div>
            <input type="number" class="form-control add" placeholder="">
            <span class="text-danger"><?php if (isset($add_error)) echo $add_error; ?></span>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text">ลด </span>
            </div>
            <input type="number" class="form-control minus" placeholder="">
            <span class="text-danger"><?php if (isset($minus_error)) echo $minus_error; ?></span>
          </div>

        <div class="form-group">
          <label for="name" class="font-weight-bold">แต้มที่อัพเดทแล้ว</label>
          <span class="input-group-text result" id="basic-addon1"></span>
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

//sum script
$(function(){
$('.add, .minus').on('blur', function(e){
  var add = parseFloat( $('.add').val() ),
      minus = parseFloat( $('.minus').val() );

  if( isNaN(add) || isNaN(minus) ) {
    $('.result').text('');
    return false;
  }

  var total = add + minus;
  $('.result').text( total );
});
});
</script>
<?php
require '../../template/back/footer.php';
?>
