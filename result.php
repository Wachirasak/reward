<?php session_start();
        include_once 'dbconnect.php';


        if (isset($_SESSION['usr_id'])=="") {
            header("Location: index.php");
        }

        //fetch user info
        if(isset($_SESSION['usr_id'])) {
        $user_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
        $sql_user = "SELECT * FROM users WHERE id ="  . $user_id;
        $result_user = mysqli_query($con, $sql_user);
        $row_user = mysqli_fetch_array($result_user);
        }

        $title = "ตะกร้าสินค้า";
        require 'template/front/member_header.php';
?>

        <!-- Page Body -->
        <div class="row login-zone" >
          <div class="col-lg-6" style="background-color:#f9f9f9; vertical-align: middle; padding:10px " id="loginzone">
          <h1><strong><?php echo $row_user['firstname'] ?> <?php echo $row_user['lastname'] ?></strong></h1>
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

          </div>
          </div>
        <div class="container-fluid">
          <div class="row">
              <div class="col">
                  <h3><?php if (isset($_SESSION['order_success'])) { echo $_SESSION['order_success'];
                                                      unset($_SESSION['order_success']); } ?></h3>
              </div>
              <div class="col">
                  <h2 style="color: #2f5caa; text-align:center;">แต้มที่เหลือ: <strong><?php echo $row_user['own_point'];?></strong></h2>
              </div>
          </div>
        </div>
</div>
        <!-- END Page Body -->
<?php
        require 'template/front/footer.php';
?>
