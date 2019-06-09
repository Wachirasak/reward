<?php session_start();
      include_once 'dbconnect.php';

      $title = "KTReward";

      require 'library/core.php';
      if(isset($_SESSION['usr_id'])!="") {
        require 'template/front/member_header.php';
      } else {
        require 'template/front/header.php';
      }      require 'template/front/thaidate.php';


?>

      <!-- Page Body -->
    <div class="container-fluid">
      <h2 class="mt-1">วิธีสมัครสมาชิก</h2><br />
      <div >
      <p>วิธีการสะสมแต้ม เพื่อแลกของรางวัลสุดพิเศษจากทางเว็บไซต์ <a href="http://www.ktreward.com">www.ktreward.com</a><br/><br/>เพียงแค่ท่านสมัครเป็นสมาชิกในเว็บไซต์ KRATOMBET</p>
<ol>
<li>
<h3><a href="http://www.kratombet.com">www.kratombet.com</a></h3>
</li>
</ol>
<p>ท่านก็จะเป็นสมาชิกกับทางเรา และได้รับสิทธิ์ในการสะสมแต้ม โดยอัตโนมัติ<br/><br/>หรือเลือกสมัครผ่าน LINE ด้านล่าง</p>
</div>
<h2 class="mt-1">สมัครผ่าน LINE </h2><br />
<p><a href="http://line.me/ti/p/@kratombet target="_blank" rel="noopener"><img src="img/linekratombet.png" alt="" width="25%" height="25%"/></a></p>

<?php if(isset($_SESSION['usr_id'])!="") { ?>
        <div class="cartbutton">
        <div>
          <button type="button" name="cartbutton" class="btn btn-md btn-primary btn-block bt-reward" onclick="cartbutton()"><i class="fas fa-shopping-cart"></i>
          ตะกร้าสินค้า
          </button>
        </div>
	      </div>
      <?php } else { ?> 
      <div class="linebutton">
            <div>
              <button type="button" name="linebutton" class="btn btn-md btn-primary btn-block bt-reward" onclick="line()"><i class="fab fa-line"></i>
              สมัครผ่านไลน์
              </button>
            </div>
            </div>
      <?php } ?>
            <script>

            function line() {
               window.location.href = 'http://line.me/ti/p/@kratombet';
            }

            function cartbutton() {
               window.location.href = 'cart.php';
            }
            </script>
<!-- END Page Body -->
  <?php
  require 'template/front/footer.php';
  ?>
