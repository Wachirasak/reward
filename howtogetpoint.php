<?php session_start();
      include_once 'dbconnect.php';

      $title = "KTReward";

      require 'library/core.php';
      if(isset($_SESSION['usr_id'])!="") {
        require 'template/front/member_header.php';
      } else {
        require 'template/front/header.php';
      }
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
<p>โดยทุกๆยอดฝาก 200 บาท ในแต่ละครั้ง ท่านจะได้รับ 1 แต้ม เพื่อสะสมแลกของรางวัลกับทางเรา</p>
<p>&lt; ตัวอย่างการได้รับแต้ม &gt;</p>

<ol>
<li>ฝาก 199 บาท ไม่ได้รับแต้มใดๆ</li>
<li>ฝาก 200 บาท ได้รับ 1 แต้ม</li>
<li>ฝาก 250 บาท ได้รับ 1 แต้ม</li>
<li>ฝาก 400 บาท ได้รับ 2 แต้ม</li>
<li>ฝาก 500 บาท ได้รับ 2 แต้ม</li>
</ol>
<p>หรือ ฝาก 100 บาท เข้ามา 2 ครั้ง รวมเป็น 200 ก็ไม่ได้รับแต้ม ต้องรวมยอดฝากในแต่ละครั้งครบหรือเกิน 200 บาท ขึ้นไปถึงจะได้รับแต้ม</p><br/>
<h2 class="mt-1">กฏกติกา และข้อตกลงในการเล่น</h2><br />
<p>1. ทางเว็บไซต์จะแจกของรางวัลให้สมาชิกที่มีพฤติกรรมการเล่นที่ปกติเท่านั้น <br/>
2. ทางเว็บไซต์จะให้ของรางวัลโดยตรงกับข้อมูลที่ท่านสมาชิกสมัครมาในครั้งแรกเท่านั้น<br/>
3. กรณีที่ทางเว็บไซต์ตรวจพบว่า ท่านสมาชิกโกง หรือเอาเปรียบทางเว็บไซต์ ทางเว็บไซต์จะขอไม่ให้ของรางวัล ยึดแต้ม และเงินที่ใช้ในการเล่นทั้งหมด<br/>เช่น มีการเล่นแทงสวนกันในยูสเซอร์เดียวกัน เพื่อทำเทิร์นโอเวอร์กลับไป แล้วกดขอของรางวัลไป<br/>
4. กรณีเกิดปัญหาในการแจกรางวัลต่างๆ ทางเว็บไซต์ มีสิทธิ์ในการตัดสินใจในปัญหานั้นๆ และถือว่าเป็นที่สิ้นสุด</p>
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
