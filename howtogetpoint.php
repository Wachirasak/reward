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

      $title = "KTReward วิธีสะสมแต้ม";

      require 'library/core.php';
      require 'template/front/member_header.php';
      require 'template/front/thaidate.php';


?>

      <!-- Page Body -->
    <div class="container-fluid">
      <h2 class="mt-1">วิธีสะสมแต้ม</h2><br />
      <div >
<p style="color: #000;">วิธีการสะสมแต้ม เพื่อแลกของรางวัลสุดพิเศษจากทางเว็บไซต์ WWW.KTREWARD.COM</p>
<p style="color: #000;">ง่ายๆ เพียงแค่ท่านสมัครเป็นสมาชิกในเว็บไซต์ WWW.KRATOMBET.COM<br/>
<p style="color: #000;">ท่านก็จะได้รับสิทธิ์ในการสะสมแต้ม โดยอัตโนมัติ<br/><br/>
</div>
<h2 class="mt-1">กติกาในการรับแต้มรางวัล</h2><br />
      <div >
<p style="color: #000;">โดยทุกๆยอดฝาก 200 บาท ในแต่ละครั้ง ท่านจะได้รับ 1 แต้ม เพื่อสะสมแลกของรางวัลกับทางเรา</p>
<p style="color: #000;">< ตัวอย่างการได้รับแต้ม ><br/>
<br/>โปรดอ่านกฏกติกา และข้อตกลงในการร่วมกิจกรรมได้ที่ &gt;&gt;<a href="getpoint.php" target="_blank" rel="noopener"> กฏกติกาและวิธีเล่น</a></p>
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
