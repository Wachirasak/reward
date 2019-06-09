<?php session_start();
      include_once 'dbconnect.php';

      $title = "KTReward วิธีสะสมแต้ม";

      require 'library/core.php';
      if(isset($_SESSION['usr_id'])!="") {
        require 'template/front/member_header.php';
      } else {
        require 'template/front/header.php';
      }      require 'template/front/thaidate.php';


?>

      <!-- Page Body -->
    <div class="container-fluid">
      <h2 class="mt-1">การจัดส่งของรางวัล</h2><br />
      <div >
      <li><strong>1. หมวดหมู่ เงินสด<br/><br/></strong>ทางเว็บไซต์จะโอนเข้า บัญชีธนาคาร ตามที่ท่านสมาชิกได้ลงทะเบียนไว้ กับ Username ที่ท่านสมาชิก Login เข้ามาเท่านั้น<br/><br/></li>
<li><strong>2. หมวดหมู่ เครดิตเว็บไซต์<br/></strong><br/>ทางเว็บไซต์จะเติมเข้า Username ตามที่ท่านสมาชิกได้ Login เข้ามาแลกรางวัลเครดิตเท่านั้น<br/><br/></li>
<li><strong>3. หมวดหมู่ อื่นๆ ที่นอกเหนือจากข้อ 1 และ 2<br/><br/></strong>ทางเว็บไซต์จะจัดส่งตามที่อยู่ ที่ท่านสมาชิกได้แจ้งตอนกดแลกของรางวัล โดยชื่อผู้รับจะเป็นชื่อ นามสกุล ของท่านสมาชิก ตอนที่ลงทะเบียนตอนสมัครเท่านั้น<br/>โดยก่อนการจัดส่ง ทางเว็บไซต์จะติดต่อ โดยการโทรศัพท์เพื่อยืนยันการจัดส่งกับทางท่านสมาชิกทุกครั้ง<br/><br/>การจัดส่งพัสดุ ของรางวัล จะจัดส่งโดย บริษัทขนส่งเอกชน Kerry Express เคอรี่ เอ็กซ์เพรส (ประเทศไทย) จำกัด เท่านั้น<br/>เมื่อท่านสมาชิกได้รับเลขส่งรางวัลเรียบร้อยแล้ว สามารถตรวจเช็คสถาณะการจัดส่งที่ <a href="https://th.kerryexpress.com/th/track/">https://th.kerryexpress.com/th/track/</a></li>

</div>
            </div>

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
