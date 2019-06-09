<?php session_start();

include_once '../../dbconnect.php';

// fetch หมวดหมู่
$sql = "SELECT * FROM product_categories order by id";
$result = mysqli_query($con, $sql);

$title = "เพิ่มสินค้า";

require '../../library/core.php';
require '../../template/back/header.php';

$error = false;

if (isset($_POST['submit'])) {
        // Upload image
        $ext = pathinfo(basename ($_FILES['image']['name']), PATHINFO_EXTENSION);
        $new_image_name = 'img_'.uniqid().".".$ext;
        $image_path = "images/";
        $upload_path = $image_path.$new_image_name;
        move_uploaded_file($_FILES['image']['tmp_name'],$upload_path);
        $image = $new_image_name;

        $name = mysqli_real_escape_string($con, $_POST['name']);
        $detail = mysqli_real_escape_string($con, $_POST['detail']);
        $point = mysqli_real_escape_string($con, $_POST['point']);
        $product_category_id = mysqli_real_escape_string($con, $_POST['product_category_id']);

        if (!preg_match("/^[0-9]+$/",$point)) {
          $error = true;
          $point_error = "กรุณาใส่แต้มที่ใช้ให้ถูกต้อง";
        }
        if (!$error) {
        if(mysqli_query($con, "INSERT INTO products(name,detail,point,image,product_category_id) VALUES('".$name."','".$detail."','".$point."',
        '$image','".$product_category_id."')")){
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal();';
          echo '}, 100);</script>';
          //$successmsg = "เพิ่มสินค้าเรียบร้อยแล้ว <a href='index.php'>กลับ</a>";
          } else {
          $errormsg = "ไม่สามารถเพิ่มได้ กรุณาลองใหม่อีกครั้ง";
            }
          }
       }


?>
<div class="container-fluid">
  <h2 class="mt-1">เพิ่มสินค้า</h2>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 card card-body bg-light" style="margin-top:20px; margin-left:20px;">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="addproductform" enctype="multipart/form-data">
				<fieldset>
					<div class="form-group">
						<label for="name" class="font-weight-bold">ชื่อสินค้า</label>
						<input type="text" name="name" placeholder="ชื่อสินค้า" required  class="form-control" value="<?php if($error) echo $name;?>" />
					</div>

          <div class="form-group">
           <label for="name" class="font-weight-bold">รายละเอียด</label>
           <input type="text" name="detail" placeholder="รายละเอียด" required  class="form-control" value="<?php if($error) echo $name;?>" />
         </div>

         <div class="form-group">
          <label for="name" class="font-weight-bold">แต้มที่ใช้แลก</label>
          <input type="text" name="point" placeholder="แต้มที่ใช้แลก" required  class="form-control" value="<?php if($error) echo $point;?>" />
          <span class="text-danger"><?php if (isset($point_error)) echo $point_error; ?></span>
         </div>

					<div class="form-group">
						<label for="name" class="font-weight-bold">หมวดหมู่</label>
            <select name="product_category_id" class="form-control input-sm">
            <?php while($row = mysqli_fetch_array($result)) { ?>
                  <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
					</div>

					<div class="form-group">
						<label for="name" class="font-weight-bold">รูป</label>
            <input type="file" name="image">
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
      title: 'เพิ่มสินค้าแล้ว',
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
