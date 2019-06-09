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

require '../../library/core.php';
require '../../template/back/header.php';
?>

<div class="container-fluid">
  <h2 class="mt-1">จัดการหมวดหมู่สินค้า</h2>
  <div class="row">
  <div class="col-xl-7">
  <div class="card" style="margin-top:1rem;">
           <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อหมวดหมู่</th>
                        <th>รหัส</th>
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
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
           </div>
          </div>
          </div>
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
