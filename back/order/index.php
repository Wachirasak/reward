<?php session_start();
    include_once '../../dbconnect.php';

    // fetch orders

    $sql = "SELECT *,orders.id as oid, users.firstname as fname, users.lastname as lname FROM orders INNER JOIN users ON orders.user_id = users.id ORDER BY status";
    $result = mysqli_query($con, $sql);


    if (isset($_GET['id'])) {
        $sql = "DELETE FROM orders WHERE id=" . $_GET['id'];
        @mysqli_query($con, $sql);
        header("Location: index.php");
    }
$title = "รายการขอแลก";

require '../../template/back/header.php';
?>

<div class="container-fluid">
  <h2 class="mt-1">รายการขอแลก</h2>
           <div class="table-responsive" style="margin-top:17px;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อ</th>
                        <th>Username</th>
                        <th>แต้มที่ใช้</th>
                        <th>วันที่สร้าง</th>
                        <th>สถานะ</th>
                        <th colspan="2" style="text-align:center"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $cnt = 1;
                    while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['oid']; ?></td>
                        <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
                        <td><?php echo $row['ins_username']; ?></td>
                        <td><?php echo $row['total_point']; ?></td>
                        <td><?php echo $row['order_date']; ?></td>
                        <?php if($row['status'] == '1') { ?>
                        <td style='color:blue';>รอการยืนยัน</td>
                        <?php } elseif($row['status'] == '2') { ?>
                          <td style='color:green';>จัดส่งเรียบร้อยแล้ว</td>
                        <?php } else { ?>
                          <td style='color:red';>ยกเลิกแล้ว</td>
                        <?php } ?>
                        <td>
                        <button name="detail" class="btn btn-info btn-sm" onclick=""><i class="fas fa-pencil-alt"></i> เปลี่ยนสถานะ</button>
                        <button name="detail" class="btn btn-secondary btn-sm" onclick="order_details(<?php echo $row['oid']; ?> )"><i class="fas fa-info-circle"></i> รายละเอียด</button>
                        <button name="delete" class="btn btn-danger btn-sm" onclick="delete_order(<?php echo $row['oid']; ?>)"><i class="fas fa-trash-alt"></i> ลบ</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
           </div>
           <!--12.display number of records -->
           <div class="panel-footer"><?php echo mysqli_num_rows($result) . " records found"; ?></div>
        </div>


<script>

   function delete_order(oid) {
       if (confirm('คุณยืนยันต้องการจะลบข้อมูลนี้ ใช่หรือไม่?')) {
           window.location.href = 'index.php?id=' + oid;
       }
   }
   function add_user() {
      window.location.href = 'create.php';
   }
   function order_details(id) {
      window.location.href = 'order_details.php?id=' + id;
   }
</script>

<?php
require '../../template/back/footer.php';
?>
