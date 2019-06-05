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

      $sql2 = "SELECT * FROM point_history WHERE user_id= $id ORDER BY id";
      $result2 = mysqli_query($con, $sql2);
          }

      $title = "ประวัติแต้ม";

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
          <h4><a href="history.php" rel="noopener"> ประวัติการแลก</a></h4>
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
      <h2 class="mt-1">ประวัติแต้ม</h2>
      <div class="row">
               <div class="table-responsive" style="margin-top:17px;">
                <table class="table table-hover" style="border-collapse: collapse; ">
                    <thead>
                        <tr>
                            <th style="text-align:right;border-right: solid 1px #e9dede;">#</th>
                            <th style="text-align:right;border-right: solid 1px #e9dede;">เพิ่มแต้ม</th>
                            <th style="text-align:right;border-right: solid 1px #e9dede;">ลดแต้ม</th>
                            <th style="text-align:right;border-right: solid 1px #e9dede;">โปรโมชัน</th>
                            <th style="text-align:right;border-right: solid 1px #e9dede;">หมายเหตุ</th>
                            <th style="text-align:right;border-right: solid 1px #e9dede;">วันที่สร้าง</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $cnt = 1;
                        while($row2 = mysqli_fetch_array($result2)) { ?>
                        <tr>
                            <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"><?php echo $cnt++; ?></td>
                            <?php if($row2['add_point'] == '0') {?>
                            <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"></td>
                            <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede; color:red;"><?php echo $row2['minus_point']; ?></td>
                            <?php } elseif($row2['minus_point'] == '0') { ?>
                            <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede; color:green;"><?php echo $row2['add_point']; ?></td>
                            <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"></td>
                            <?php } else { ?>
                            <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede; color:green;"><?php echo $row2['add_point']; ?></td>
                            <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede; color:red;"><?php echo $row2['minus_point']; ?></td>
                            <?php } ?>
                            <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"><?php echo $row2['promotion']; ?></td>
                            <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"><?php echo $row2['note']; ?></td>
                            <td style="text-align:right;border-right: solid 1px #e9dede;border-bottom:solid 1px #e9dede;"><?php echo thaidate($row2['created']); ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>
               </div>
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
            function cartbutton() {
               window.location.href = 'cart.php';
            }
            </script>
	<!-- END Page Body -->
  <?php
  require 'template/front/footer.php';
  ?>
