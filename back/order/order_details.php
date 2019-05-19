<?php session_start();
    include_once '../../dbconnect.php';

    $id = mysqli_real_escape_string($con,  $_GET['id']);

    $sql = "SELECT * FROM orders WHERE id =" . $id;
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);

    $sql2 = "SELECT users.firstname as fname, users.lastname as lname FROM orders INNER JOIN users ON orders.user_id = users.id";
    $result2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_array($result2);

    $sql3 = "SELECT * FROM order_details WHERE order_id =" . $_GET['id'];
    $result3 = mysqli_query($con,$sql3);

    $title = "รายละเอียดการสั่งซื้อสินค้า";

    require '../../template/back/header.php';
    ?>


    <div class="container-fluid">
      <h2 class="mt-1">ข้อมูลติดต่อและที่อยู่จัดส่ง</h2>
    	<div class="row" style="margin-top:20px;">
        <div class="col-lg-6">
          <ul class="list-group">
                        <li class="list-group-item"><strong>ชื่อ-นามสกุล</strong> : <?php echo $row2['fname']; ?> <?php echo $row2['lname']; ?></li>
                        <li class="list-group-item"><strong>เบอร์โทรศัพท์</strong> : <?php echo $row['phone'];?></li>
                        <li class="list-group-item"><strong>ไอดีไลน์</strong> : <?php echo $row['lineid'];?></li>
                        <li class="list-group-item"><strong>ยูสเซอร์เนม / Username</strong> : <?php echo $row['ins_username'];?></li>
                        <li class="list-group-item"><strong>ที่อยู่</strong> : <?php echo $row['address'];?></li>
                        <li class="list-group-item"><strong>แขวง/ตำบล เขต/อำเภอ</strong> : <?php echo $row['district'];?></li>
                        <li class="list-group-item"><strong>จังหวัด</strong> : <?php echo $row['province'];?></li>
                        <li class="list-group-item"><strong>รหัสไปรษณีย์</strong> : <?php echo $row['zipcode'];?></li>
                        <li class="list-group-item"><strong>ประเทศ</strong> : <?php echo $row['country'];?></li>
                        <li class="list-group-item">*วันที่สร้าง <?php echo $row['order_date'];?></li>
                    </ul>
        </div>
        <div class="col-lg-6">
          <table class="table" >
                          <thead>
                              <tr>
                                  <th>ชื่อสินค้า</th>
                                  <th style="text-align: right;">ราคา(แต้ม)</th>
                                  <th style="text-align: right;">จำนวน</th>
                                  <th style="text-align: right;">รวม</th>
                              </tr>
                          </thead>
                          <tbody>
                                      <?php
                                      $total=0;
                                      while($row3 = mysqli_fetch_array($result3)) {
                                      $sum = $row3['point'] * $row3['quantity'];
                                  		$total+= $sum;
                                      ?>
                                  <tr>
                                      <td><?php echo $row3['product_name'];?></td>
                                      <td style="text-align: right;"><?php echo $row3['point'];?></td>
                                      <td style="text-align: right;"><?php echo $row3['quantity'];?></td>
                                      <td style="text-align: right;"><?php echo $sum;?></td>
                                  </tr>
                                  <?php } ?>
                                  <tr class="info">
                                      <td colspan="5" style="text-align: right;">
                                      รวมทั้งหมด <strong><?php echo $total;?></strong> แต้ม
                                      </td>

                                </tr>
                          </tbody>
                      </table>
        </div>
      </div>
    </div>

    <?php
    require '../../template/back/footer.php';
    ?>
