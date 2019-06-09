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
      <h2 class="mt-1">ติดต่อ</h2><br />
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
