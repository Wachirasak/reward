<?php session_start();
    include_once '../../dbconnect.php';

    // fetch records
    if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $sql = "SELECT * FROM point_history WHERE user_id = $id ORDER BY id";
    $result = mysqli_query($con, $sql);
    }

    $sql2 = "SELECT * FROM users WHERE id= $id";
    $result2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_array($result2);

$title = "ประวัติแต้ม";

require '../../library/core.php';
require '../../template/back/header.php';
require '../../template/back/thaidate.php';

?>

<div class="container-fluid">
  <h2 class="mt-1">ประวัติแต้มของ <?php echo $row2['firstname']; ?> <?php echo $row2['lastname']; ?></h2>
  <div class="row ">
           <div class="table-responsive col-xl-10" style="margin-top:17px;">
            <table class="table table-hover" style="border-collapse: collapse; ">
                <thead>
                    <tr>
                        <th style="text-align:right;border-right: solid 1px #e9dede;border-left: solid 1px #e9dede; width:50px;">#</th>
                        <th style="text-align:right;border-right: solid 1px #e9dede; width:120px;">เพิ่มแต้ม</th>
                        <th style="text-align:right;border-right: solid 1px #e9dede; width:120px;">ลดแต้ม</th>
                        <th style="text-align:right;border-right: solid 1px #e9dede; width:170px;">โปรโมชัน</th>
                        <th style="text-align:right;border-right: solid 1px #e9dede; width:200px;">หมายเหตุ</th>
                        <th style="text-align:right;border-right: solid 1px #e9dede; width:200px;">แอดมินผู้ดำเนินการ</th>
                        <th style="text-align:right;border-right: solid 1px #e9dede; width:200px;">วันที่สร้าง</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $cnt = 1;
                    while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-left: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"><?php echo $cnt++; ?></td>
                        <?php if($row['add_point'] == '0') {?>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"></td>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede; color:red;"><?php echo $row['minus_point']; ?></td>
                        <?php } elseif($row['minus_point'] == '0') { ?>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede; color:green;"><?php echo $row['add_point']; ?></td>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"></td>
                        <?php } else { ?>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede; color:green;"><?php echo $row['add_point']; ?></td>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede; color:red;"><?php echo $row['minus_point']; ?></td>
                        <?php } ?>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"><?php echo $row['promotion']; ?></td>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"><?php echo $row['note']; ?></td>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"><?php echo $row['admin']; ?></td>
                        <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"><?php echo thaidate($row['created']); ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
           </div>
         </div>
        </div>
    </div>
</div>

<?php
require '../../template/back/footer.php';
?>
