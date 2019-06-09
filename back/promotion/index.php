<?php session_start();
    include_once '../../dbconnect.php';

    // fetch records
    $sql = "SELECT * FROM promotion order by code";
    $result = mysqli_query($con, $sql);

    if (isset($_GET['id'])) {
        $sql = "DELETE FROM promotion WHERE id=" . $_GET['id'];
        @mysqli_query($con, $sql);
        header("Location: index.php");
    }
$title = "จัดการโปรโมชัน";

require '../../library/core.php';
require '../../template/back/header.php';
?>

<div class="container-fluid">
  <h2 class="mt-1">จัดการโปรโมชัน</h2>
  <button name="adduser" class="btn btn-success btn-sm" onclick="add_promotion()"><i class="fas fa-plus-circle"></i> เพิ่มโปรโมชัน</button>
  <div class="row">
  <div class="col-lg-8">
  <div class="card" style="margin-top:1rem;">
           <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รายละเอียดโปรโมชัน</th>
                        <th>รหัส</th>
                        <th colspan="2" style="text-align:center"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $cnt = 1;
                    while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $cnt++; ?></td>
                        <td><?php echo $row['detail']; ?></td>
                        <td><?php echo $row['code']; ?></td>
                        <td>
                          <button name="delete" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['id']; ?>"><i class="fas fa-trash-alt"></i> ลบ</button>
                            <!-- Modal -->
                                <div class="modal fade" id="delete<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">ลบโปรโมชัน ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        คุณยืนยันต้องการจะลบ <?php echo $row['detail']; ?> ใช่หรือไม่?
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                        <a role="button" class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">ใช่ ยืนยันการลบ</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                          </td>
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
   function delete_promotion(id) {
       if (confirm('คุณยืนยันต้องการจะลบโปรโมชันนี้ ใช่หรือไม่?')) {
           window.location.href = 'index.php?id=' + id;
       }
   }
   function add_promotion() {
      window.location.href = 'create.php';
   }
</script>

<?php
require '../../template/back/footer.php';
?>
