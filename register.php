<?php session_start();
      include_once 'dbconnect.php';

      if(isset($_SESSION['usr_id'])=="") {
  			header("Location: index.php");
  		}

      //fetch user info
      if(isset($_SESSION['usr_id'])) {
      $id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
      $sql_user = "SELECT * FROM users WHERE id ="  . $id;
      $result_user = mysqli_query($con, $sql_user);
      $row_user = mysqli_fetch_array($result_user);

      $sql2 = "SELECT * FROM orders WHERE user_id ="  . $id;
      $result2 = mysqli_query($con,$sql2);
          }

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
          <h4><a href="point_history.php" rel="noopener"> ประวัติแต้ม</a></h4>
        </div>

        </div>
        
        <div class="col-lg-6" style="background-color:#eeeeee;  vertical-align: middle; padding:10px; min-height: 269px;" >
        <div >
			<h1><strong>KRATOMBET</strong></h1>
<p style="color: #000;">สิทธิพิเศษ สำหรับสมาชิก KRATOMBET ด้วยระบบสะสมแต้มแลกของรางวัล เพื่อความคุ้มค่า และคืนกำไรให้กับท่านสมาชิกทุกท่าน โดยทุกๆยอดฝาก 200 บาท จะเท่ากับ 1 แต้ม เพื่อให้ท่านสมาชิกได้นำแต้มคะแนนมาแลกของรางวัล พรีเมียม สุดพิเศษ</p>
<p style="color: #000;">สำหรับท่านที่ยังไม่มียูสเซอร์เนม สามารถติดต่อสมัครสมาชิกได้จากข้อมูลด้านล่าง ....<br /><br />โปรดอ่านกฏกติกา และข้อตกลงในการร่วมกิจกรรมได้ที่ &gt;&gt;<a href="getpoint.php" target="_blank" rel="noopener"> กฏกติกาและวิธีเล่น</a></p>
<p style="color: #00b422;">ติดต่อ ผ่าน LINE ID : <strong>@kratombet</strong></p>        </div>
        </div>

		<div class="col-lg-12" style="padding: 0; margin: 5px 0" >
        <div >
			<a href="http://www.dootv69.com" target="_blank">
							<img src="../img/dootv69.gif" alt="Dootv69" style="width: 100%;">
			</a>
        </div>
        </div>

		</div>
    <div class="container-fluid">
      <h2 class="mt-1">ประวัติการแลก</h2>
               <div class="table-responsive" style="margin-top:17px;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>วันที่</th>
                            <th>แต้มที่ใช้</th>
                            <th>สถานะ</th>
                            <th colspan="2" style="text-align:center"></th>
                        </tr>
                    </thead>
                    <tbody>
                   <!--10.show all users in this part of table -->
                    <?php
                        while($row2 = mysqli_fetch_array($result2)) { ?>
                        <tr>
                            <td><?php echo $row2['id']; ?></td>
                            <td><?php echo thaidate($row2['order_date']); ?></td>
                            <td><?php echo $row2['total_point']; ?></td>
                            <?php if($row2['status'] == '1') { ?>
                              <td >รอการยืนยัน</td>
                              <td>
                              <button name="detail" class="btn btn-secondary btn-sm" onclick="order_details(<?php echo $row2['id']; ?> )"><i class="fas fa-info-circle"></i> รายละเอียด</button>
                              </td>
                            <?php } elseif($row2['status'] == '2') { ?>
                              <td style='color:blue';>จัดส่งเรียบร้อยแล้ว </td>
                              <td>
                              <button name="confirm" class="btn btn-success btn-sm" data-toggle="modal" data-target="#confirm<?php echo $row2['id']; ?>"><i class="fas fa-check-circle"></i> ได้รับสินค้าแล้ว</button>
                                <!-- Modal -->
                                    <div class="modal fade" id="confirm<?php echo $row2['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">ได้รับสินค้าแล้ว ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            ยืนยันว่าได้รับสินค้าแล้ว ?
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                            <a role="button" class="btn btn-success" href="confirm_order.php?id=<?php echo $row2['id']; ?>">ยืนยัน</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                              <button name="detail" class="btn btn-secondary btn-sm" onclick="order_details(<?php echo $row2['id']; ?> )"><i class="fas fa-info-circle"></i> รายละเอียด</button>
                              </td>
                            <?php } elseif($row2['status'] == '3') { ?>
                              <td style='color:green';>ได้รับสินค้าแล้ว </td>
                              <td>
                              <button name="detail" class="btn btn-secondary btn-sm" onclick="order_details(<?php echo $row2['id']; ?> )"><i class="fas fa-info-circle"></i> รายละเอียด</button>
                              </td>
                            <?php } else { ?>
                              <td style='color:red';>ยกเลิกแล้ว</td>
                              <td>
                              <button name="detail" class="btn btn-secondary btn-sm" onclick="order_details(<?php echo $row2['id']; ?> )"><i class="fas fa-info-circle"></i> รายละเอียด</button>
                              </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
               </div>
            </div>
            <div class="cartbutton">
            <div>
              <button type="button" name="cartbutton" class="btn btn-md btn-primary btn-block bt-reward" onclick="cartbutton()"><i class="fas fa-shopping-cart"></i>
              ตะกร้าสินค้า
              </button>
            </div>
            </div>
            <script>
            function order_details(id) {
               window.location.href = 'order/' + id +'#details';
            }
            function confirm_order(id) {
                if (confirm('ยืนยันว่าได้รับสินค้าแล้ว?')) {
                    window.location.href = 'confirm_order.php?id=' + id;
                }
              }
            function cartbutton() {
               window.location.href = 'cart.php';
            }
            </script>
	<!-- END Page Body -->
  <?php
  require 'template/front/footer.php';
  ?>
