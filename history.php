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
      }

      $title = "ประวัติการแลก";
      require 'template/front/member_header.php';

?>

      <!-- Page Body -->
      <div class="row login-zone" >
        <div class="col-lg-6" style="background-color:#f9f9f9; vertical-align: middle; padding:10px " id="loginzone">
		    <h1><strong><?php echo $row_user['firstname'] ?> <?php echo $row_user['lastname'] ?></strong></h1>
		    <div style="">
            <h4 style="color: #00b422;">แต้มที่มี : <strong><?php echo $row_user['own_point'];?></strong></h4>
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
    <div class="container-fluid">
      <h2 class="mt-1">ประวัติการแลก</h2>
               <div class="table-responsive" style="margin-top:17px;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>สินค้า</th>
                            <th>แต้มที่ใช้</th>
                            <th>วันที่</th>
                            <th>สถานะ</th>
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
                            <td></td>
                            <td><?php echo $row['own_point']; ?></td>
                            <td><?php echo $row['created']; ?></td>
                            <td></td>
                            <td>
                            <button name="detail" class="btn btn-info btn-sm" onclick=""><i class="fas fa-pencil-alt"></i> เปลี่ยนสถานะ</button>
                            <button name="detail" class="btn btn-secondary btn-sm" onclick=""><i class="fas fa-info-circle"></i> รายละเอียด</button>
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


	<!-- END Page Body -->
  <?php
  require 'template/front/footer.php';
  ?>
