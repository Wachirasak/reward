<?php session_start();
    include_once '../../dbconnect.php';

    // fetch records
    $sql = "SELECT * FROM users order by id";
    $result = mysqli_query($con, $sql);
    //delete
    if (isset($_GET['id'])) {
        $sql = "DELETE FROM users WHERE id=" . $_GET['id'];
        @mysqli_query($con, $sql);
        header("Location: index.php");
    }
$title = "จัดการผู้ใช้";

require '../../template/back/header.php';
?>

<div class="container-fluid">
  <h2 class="mt-1">จัดการผู้ใช้</h2>
  <button name="adduser" class="btn btn-success btn-sm" onclick="add_user()"><i class="fas fa-plus-circle"></i> เพิ่มผู้ใช้</button>
           <div class="table-responsive" style="margin-top:17px;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>Username</th>
                        <th>โทรศัพท์</th>
                        <th>แต้มที่มี</th>
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
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['own_point']; ?></td>
                        <td><?php echo $row['created']; ?></td>
                        <td>
                        <button name="detail" class="btn btn-info btn-sm" onclick="edit_point(<?php echo $row['id']; ?>)"><i class="fas fa-coins"></i> เพิ่ม/ลดแต้ม</button>
                        <button name="detail" class="btn btn-secondary btn-sm" onclick="edit_user(<?php echo $row['id']; ?>)"><i class="fas fa-pencil-alt"></i> แก้ไข</button>
                        <button name="delete" class="btn btn-danger btn-sm" onclick="delete_user(<?php echo $row['id']; ?>)"><i class="fas fa-trash-alt"></i> ลบ</button>
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
    function edit_user(id) {
       window.location.href = 'edit.php?id=' + id;
    }
   function delete_user(id) {
       if (confirm('คุณยืนยันต้องการจะลบข้อมูลนี้ ใช่หรือไม่?')) {
           window.location.href = 'index.php?id=' + id;
       }
   }
   function edit_point(id) {
      window.location.href = 'edit_point.php?id=' + id;
   }
   function add_user() {
      window.location.href = 'create.php';
   }
</script>

<?php
require '../../template/back/footer.php';
?>
