<?php session_start();
    include_once '../../dbconnect.php';

    // fetch records
    $sql = "SELECT *,products.id as pid, products.name as pname , product_categories.name as cname FROM products
            INNER JOIN product_categories ON	products.product_category_id = product_categories.id ORDER BY product_categories.id,products.point" ;
    $result = mysqli_query($con, $sql);
    //delete
    if (isset($_GET['id'])) {
        $sql = "DELETE FROM products WHERE id=" . $_GET['id'];
        @mysqli_query($con, $sql);
        header("Location: index.php");
    }
$title = "จัดการสินค้า";

require '../../template/back/header.php';
?>

<div class="container-fluid">
  <h2 class="mt-1">จัดการสินค้า</h2>
  <button name="adduser" class="btn btn-success btn-sm" onclick="add_product()"><i class="fas fa-plus-circle"></i> เพิ่มสินค้า</button>
           <div class="table-responsive" style="margin-top:17px;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อสินค้า</th>
                        <th>รายละเอียด</th>
                        <th>รูป</th>
                        <th>แต้มที่ใช้แลก</th>
                        <th>หมวดหมู่</th>
                        <th>วันที่สร้าง</th>
                        <th colspan="2" style="text-align:center"></th>
                    </tr>
                </thead>
                <tbody>
               <!--10.show all users in this part of table -->
                <?php
                    $cnt = 1;
                    while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $cnt++; ?></td>
                        <td><?php echo $row['pname']; ?></td>
                        <td><?php echo $row['detail']; ?></td>
                        <td><img src="images/<?php echo $row['image'];?>" height="100rem"</td>
                        <td><?php echo $row['point']; ?></td>
                        <td><?php echo $row['cname']; ?></td>
                        <td><?php echo $row['created']; ?></td>
                        <td>
                        <button name="detail" class="btn btn-secondary btn-sm" onclick="edit_product(<?php echo $row['pid']; ?>)"><i class="fas fa-pencil-alt"></i> แก้ไข</button>
                        <button name="delete" class="btn btn-danger btn-sm" onclick="delete_product(<?php echo $row['pid']; ?>)"><i class="fas fa-trash-alt"></i> ลบ</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
           </div>
           <!--12.display number of records -->
           <div class="panel-footer"><?php echo mysqli_num_rows($result) . " records found"; ?></div>
        </div>
    </div>
</div>

<script>
   function delete_product(pid) {
       if (confirm('คุณยืนยันต้องการจะลบข้อมูลนี้ ใช่หรือไม่?')) {
           window.location.href = 'index.php?id=' + pid;
       }
   }
   function add_product() {
      window.location.href = 'create.php';
   }
   function edit_product(pid) {
      window.location.href = 'edit.php?id=' + pid;
   }
</script>

<?php
require '../../template/back/footer.php';
?>
