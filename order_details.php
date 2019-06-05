<?php session_start();
      include_once 'dbconnect.php';

      if(isset($_SESSION['usr_id'])=="") {
  			header("Location: index.php");
  		}
      //fetch user info
      if(isset($_SESSION['usr_id'])) {
      $id = mysqli_real_escape_string($con,  $_GET['id']);
      $sql_user = "SELECT * FROM users WHERE id ="  . $id;
      $result_user = mysqli_query($con, $sql_user);
      $row_user = mysqli_fetch_array($result_user);
      }

      $sql = "SELECT * FROM orders WHERE id =" . $id;
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result);

      $sql2 = "SELECT users.firstname as fname, users.lastname as lname FROM orders INNER JOIN users ON orders.user_id = users.id";
      $result2 = mysqli_query($con, $sql2);
      $row2 = mysqli_fetch_array($result2);

      $sql3 = "SELECT * FROM order_details WHERE order_id =" . $id;
      $result3 = mysqli_query($con,$sql3);

      $title = "ประวัติการแลก";

      require 'library/core.php';
      require 'template/front/member_header.php';
      require 'template/front/thaidate.php';


?>
      <!-- Page Body -->
      <div class="row login-zone" >
        <div class="col-lg-6" style="background-color:#f9f9f9; vertical-align: middle; padding:10px " id="loginzone">
        <h1><strong><?php echo $row_user['firstname'] ?> <?php echo $row_user['lastname'] ?></strong></h1><br />
        <div style="">
          <h4 style="color: #2f5caa;">แต้มที่มี: <?php echo $row_user['own_point'];?></h4><br />
          <h4><a href="<?php echo $baseUrl; ?>/history.php" rel="noopener"> ประวัติการแลก</a></h4><br />
          <h4><a href="<?php echo $baseUrl; ?>/point_history.php" rel="noopener"> ประวัติแต้ม</a></h4>
        </div>

        </div>

        <div class="col" style="background-color:#eeeeee;  vertical-align: middle; padding:10px; min-height: 269px;" >
        <div >
      <h1><strong>THEREWARD69</strong></h1>
      <p style="color: #000;">สิทธิพิเศษ สำหรับสมาชิกในเครือ 69 ด้วยระบบสะสมแต้มแลกของรางวัล เพื่อความคุ้มค่า และคืนกำไรให้กับท่านสมาชิกทุกท่าน โดยทุกๆยอดฝาก 200 บาท จะเท่ากับ 1 แต้ม เพื่อให้ท่านสมาชิกได้นำแต้มคะแนนมาแลกของรางวัล พรีเมียม สุดพิเศษ</p>
      <p style="color: #000;">สำหรับท่านที่ยังไม่มียูสเซอร์เนม สามารถติดต่อสมัครสมาชิกได้จากข้อมูลด้านล่าง ....<br /><br />โปรดอ่านกฏกติกา และข้อตกลงในการร่วมกิจกรรมได้ที่ &gt;&gt;<a href="getpoint.php" target="_blank" rel="noopener"> กฏกติกาและวิธีเล่น</a></p>
      <p style="color: #00b422;">ติดต่อ ผ่าน LINE ID : <strong>@TheReward69</strong></p>        </div>
        </div>

      <div class="col-lg-12" style="padding: 0; margin: 5px 0" >
        <div >
      <a href="http://www.dootv69.com" target="_blank">
              <img src="../img/dootv69.gif" alt="Dootv69" style="width: 100%;">
      </a>
        </div>
        </div>

      </div>
      <div class="container-fluid" id='details'>
        <h2 class="mt-1">รายละเอียด</h2>
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
                          <li class="list-group-item">*วันที่สร้าง <?php echo thaidate($row['order_date']);?></li>
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
                      <div class="row" style="margin-top:20px;">
                      <div class="col-lg-6">
                        <ul class="list-group">
                                      <li class="list-group-item"><strong>หมายเหตุการยกเลิก (ถ้ายกเลิก)</strong> : <?php echo $row['cancel_reason']; ?></li>
                                      <li class="list-group-item"><strong>เลข EMS (ถ้ามีการส่งของ)</strong> : <?php echo $row['ems'];?></li>
                                  </ul>
                      </div>
                    </div>
                  </div>
      <!-- END Page Body -->
      <?php
      require 'template/front/footer.php';
      ?>
