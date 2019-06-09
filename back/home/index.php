<?php session_start();
    include_once '../../dbconnect.php';

    // fetch orders
    $sql = "SELECT *,orders.id as oid, users.firstname as fname, users.lastname as lname FROM orders INNER JOIN users ON orders.user_id = users.id WHERE status = 1 ORDER BY status,oid";
    $result = mysqli_query($con, $sql);

    // fetch users
    $sql2 = "SELECT * FROM users ORDER BY own_point DESC LIMIT 5";
    $result2 = mysqli_query($con, $sql2);

    // fetch จำนวน users 
    $sql3 = "SELECT * FROM users";
    $result3 = mysqli_query($con, $sql3);

    // fetch จำนวน orders 
    $sql4 = "SELECT * FROM orders";
    $result4 = mysqli_query($con, $sql4);

    // fetch จำนวนสินค้า 
    $sql5 = "SELECT * FROM products";
    $result5 = mysqli_query($con, $sql5);

    // fetch ประวัติแต้ม 
    $sql6 = "SELECT *,point_history.created as phcreated, users.username as username FROM point_history INNER JOIN users ON point_history.user_id = users.id ORDER BY point_history.created DESC LIMIT 10";
    $result6 = mysqli_query($con, $sql6);



$title = "ADMIN PAGE";
require '../../template/back/thaidate.php';
require '../../library/core.php';
require '../../template/back/header.php';
?>

     <div class="container-fluid">
       <h2 class="mt-1">ADMIN PAGE</h2>
       <div class="row">
       <div class="col-xl-2 col-lg-3 col-md-6">
       <div class="card text-white bg-info mb-3 card-index" style="max-width: 18rem;">
          <div class="card-header">จำนวนผู้ใช้ทั้งหมด</div>
          <div class="card-body">
            <h5 class="card-title" align="center"><i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo mysqli_num_rows($result3);?> คน</h5>
          </div>
        </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-6">
        <div class="card text-white bg-info mb-3 card-index" style="max-width: 18rem;">
          <div class="card-header">จำนวนรายการขอแลกทั้งหมด</div>
          <div class="card-body">
            <h5 class="card-title" align="center"><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo mysqli_num_rows($result4);?> รายการ</h5>
          </div>
        </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-6">
        <div class="card text-white bg-info mb-3 card-index" style="max-width: 18rem;">
          <div class="card-header">จำนวนสินค้าทั้งหมด</div>
          <div class="card-body">
            <h5 class="card-title" align="center"><i class="fas fa-list-ul"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo mysqli_num_rows($result5);?> รายการ</h5>
          </div>
        </div>
       </div>
       </div>
       <div class="row">
          <div class="col-lg-6" >
          <div class="card card-index mb-4">
          <h4 class="card-header bg-white">รายการขอแลกที่รออยู่<button style="margin-left:auto;" class="btn btn-info btn-sm" onclick="updateOrders();"><i class="fas fa-sync-alt"></i> อัพเดท</button></h4>
          <div id="orders">
           <div class="table-responsive ">
            <table class="table card-body" style="">
                <thead>
                    <tr>
                        <th>รหัส</th>
                        <th>Username</th>
                        <th>แต้มที่ใช้</th>
                        <th>วันที่สร้าง</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['oid']; ?></td>
                        <td><?php echo $row['ins_username']; ?></td>
                        <td><?php echo $row['total_point']; ?></td>
                        <td><?php echo thaidate($row['order_date']); ?></td>
                        <td>รอการยืนยัน</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
           </div>
         </div>
         </div>
         <div class="card card-index mb-4" >
          <h4 class="card-header bg-white">ประวัติแต้มล่าสุด<button style="margin-left:auto;" class="btn btn-info btn-sm" onclick="updatePointhistory();"><i class="fas fa-sync-alt"></i> อัพเดท</button></h4>
          <div id="point_history">
           <div class="table-responsive ">
            <table class="table ">
                <thead>
                    <tr>
                        <th style="text-align:right;border-right: solid 1px #e9dede;">Username</th>
                        <th style="text-align:right;border-right: solid 1px #e9dede;">เพิ่มแต้ม</th>
                        <th style="text-align:right;border-right: solid 1px #e9dede;">ลดแต้ม</th>
                        <th style="text-align:right;border-right: solid 1px #e9dede;">หมายเหตุ</th>
                        <th style="text-align:right;">วันที่สร้าง</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row6 = mysqli_fetch_array($result6)) { ?>
                    <tr>
                        <td style="text-align:right;border-right: solid 1px #e9dede;"><?php echo $row6['username']; ?></td>
                        <?php if($row6['add_point'] == '0') {?>
                        <td style="text-align:right; color:green; border-right: solid 1px #e9dede;"></td>
                        <td style="text-align:right; color:red; border-right: solid 1px #e9dede;"><?php echo $row6['minus_point']; ?></td>
                        <?php } elseif($row6['minus_point'] == '0') { ?>
                        <td style="text-align:right; color:green; border-right: solid 1px #e9dede;"><?php echo $row6['add_point']; ?></td>
                        <td style="text-align:right; color:red; border-right: solid 1px #e9dede;"></td>
                        <?php } else { ?>
                        <td style="text-align:right; color:green;border-right: solid 1px #e9dede;"><?php echo $row6['add_point']; ?></td>
                        <td style="text-align:right; border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede; color:red;"><?php echo $row6['minus_point']; ?></td>
                        <?php } ?>
                        <td style="text-align:right; border-right: solid 1px #e9dede;"><?php echo $row6['note']; ?></td>
                        <td style="text-align:right;"><?php echo thaidate($row6['phcreated']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
           </div>
         </div>
         </div>
          </div>
          <div class="col-lg-6">
          <div class="card card-index mb-3">
          <h4 class="card-header bg-white">ผู้ใช้ที่มีแต้มสูงสุด<button style="margin-left:auto;" class="btn btn-info btn-sm" onclick="updateUsers();"><i class="fas fa-sync-alt"></i> อัพเดท</button></h4>
          <div id="users">
           <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>โทรศัพท์</th>
                        <th>แต้มที่มี</th>
                        <th>วันที่สร้าง</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row2 = mysqli_fetch_array($result2)) { ?>
                    <tr>
                        <td><?php echo $row2['username']; ?></td>
                        <td><?php echo $row2['phone']; ?></td>
                        <td><?php echo $row2['own_point']; ?></td>
                        <td><?php echo thaidate($row2['created']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
          </div>
       </div>
       </div>
     </div>
     </div>
     

<script>
   function updateOrders() {
     $('#orders').load(document.URL +  ' #orders');    }
   function updateUsers() {
     $('#users').load(document.URL +  ' #users');    }
     function updatePointhistory() {
     $('#point_history').load(document.URL +  ' #point_history');    }
</script>

<?php
require '../../template/back/footer.php';
?>
