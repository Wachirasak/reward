<?php session_start();

include_once '../../dbconnect.php';

if (isset($_GET['id'])) {
$id = mysqli_real_escape_string($con, $_GET['id']);
$sql = "SELECT * FROM products WHERE id = " . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
}

$error = false;

if (isset($_POST['submit'])) {

        $name = mysqli_real_escape_string($con, $_POST['name']);
        $detail = mysqli_real_escape_string($con, $_POST['detail']);
        $point = mysqli_real_escape_string($con, $_POST['point']);
        $product_category_id = mysqli_real_escape_string($con, $_POST['product_category_id']);
        $id = mysqli_real_escape_string($con, $_POST['id']);

        if (!preg_match("/^[0-9]+$/",$point)) {
          $error = true;
          $point_error = "กรุณาใส่แต้มที่ใช้ให้ถูกต้อง";
        }
        if (!$error) {
        if(mysqli_query($con, "UPDATE products SET name = '".$name."', detail = '".$detail."' , point = '".$point."' ,
        product_category_id = '".$product_category_id."'WHERE id = " . $id)){
          $successmsg = "แก้ไขสินค้าเรียบร้อยแล้ว <a href='index.php'>กลับ</a>";
          header("Location: index.php");
          } else {
          $errormsg = "ไม่สามารถแก้ไขได้ กรุณาลองใหม่อีกครั้ง";
            }
          }
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            //delete old image
            $sql_oldimage = "SELECT image FROM products WHERE id = " . $id;
            $result_oldimage = mysqli_query($con, $sql_oldimage);
            $row_oldimage = mysqli_fetch_assoc($result_oldimage);
            unlink("images/".$row_oldimage['image']);
            // update image
            $ext = pathinfo(basename ($_FILES['image']['name']), PATHINFO_EXTENSION);
            $new_image_name = 'img_'.uniqid().".".$ext;
            $image_path = "images/";
            $upload_path = $image_path.$new_image_name;
            $image = $new_image_name;
            move_uploaded_file($_FILES['image']['tmp_name'],$upload_path);
            $sql_image = "UPDATE products SET image = '".$image."' WHERE id = " . $id;
            mysqli_query($con, $sql_image);
    }
}

$title = "แก้ไขสินค้า";
require '../../template/back/header.php';

$error = false;

?>
<div class="container-fluid">
  <h2 class="mt-1">แก้ไขสินค้า </h2>
	<div class="row">
		<div class="col-xl-4 col-xl-offset-4 card card-body bg-light" style="margin-top:20px; margin-left:20px;">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="editproductform" enctype="multipart/form-data">
				<fieldset>
					<div class="form-group">
            <input type="hidden" name="id" value="<?php if(isset($row['id'])) { echo $row['id']; } else { echo $_POST['id']; } ?>" />
						<label for="name" class="font-weight-bold">ชื่อสินค้า</label>
						<input type="text" name="name" placeholder="ชื่อสินค้า" required value="<?php if(isset($row['name'])) { echo $row['name']; } else { echo $_POST['name']; } ?>"  class="form-control" />
					</div>

          <div class="form-group">
           <label for="name" class="font-weight-bold">รายละเอียด</label>
           <input type="text" name="detail" placeholder="รายละเอียด" required value="<?php if(isset($row['detail'])) { echo $row['detail']; } else { echo $_POST['detail']; } ?>" class="form-control" />
         </div>

         <div class="form-group">
          <label for="name" class="font-weight-bold">แต้มที่ใช้แลก</label>
          <input type="text" name="point" placeholder="แต้มที่ใช้แลก" required value="<?php if(isset($row['point'])) { echo $row['point']; } else { echo $_POST['point']; } ?>" class="form-control" />
          <span class="text-danger"><?php if (isset($point_error)) echo $point_error; ?></span>
        </div>

					<div class="form-group">
						<label for="name" class="font-weight-bold">หมวดหมู่</label>
            <select name="product_category_id" class="form-control input-sm" >
              <?php // fetch หมวดหมู่
              $sql_cate = "SELECT * FROM product_categories";
              $result_cate = mysqli_query($con, $sql_cate);
              while($row_cate = mysqli_fetch_assoc($result_cate)) {
                  if ($row_cate['id'] == $row['product_category_id']) { ?>
                    <option value="<?php echo $row_cate['id']; ?>" selected><?php echo $row_cate['name']; ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $row_cate['id']; ?>"><?php echo $row_cate['name']; ?></option>
                  <?php } }?>
            </select>
					</div>

					<div class="form-group">
						<label for="name" class="font-weight-bold">รูปภาพ</label>
            <td><img src="images/<?php echo $row['image'];?>" height="100rem"</td>
            <input type="file" name="image" id="image">
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
