<?php session_start();
    include_once '../../dbconnect.php';

    // fetch records
    $sql = "SELECT * FROM product_categories order by code";
    $result = mysqli_query($con, $sql);

    if (isset($_GET['id'])) {
        $sql = "DELETE FROM product_categories WHERE id=" . $_GET['id'];
        @mysqli_query($con, $sql);
        header("Location: index.php");
    }
$title = "จัดการหมวดหมู่สินค้า";

require '../../template/back/header.php';
?>

<div class="container-fluid">
  <h2 class="mt-1">จัดการหมวดหมู่สินค้า</h2>
  <button name="adduser" class="btn btn-success btn-sm" onclick="add_productcategory()"><i class="fas fa-plus-circle"></i> เพิ่มหมวดหมู่สินค้า</button>
           <div class="table-responsive" style="margin-top:17px;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อหมวดหมู่</th>
                        <th>รหัส</th>
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
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['code']; ?></td>
                        <td>
                          <button name="delete" class="btn btn-danger btn-sm" onclick="delete_productcategory(<?php echo $row['id']; ?>)"><i class="fas fa-trash-alt"></i> ลบ</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
           </div>
        </div>
    </div>
</div>

<script>
   function delete_productcategory(id) {
       if (confirm('คุณยืนยันต้องการจะลบข้อมูลนี้ ใช่หรือไม่?')) {
           window.location.href = 'index.php?id=' + id;
       }
   }
   function add_productcategory() {
      window.location.href = 'create.php';
   }
</script>

<?php
require '../../template/back/footer.php';
?>
