<?php session_start();
      include_once 'dbconnect.php';

      if(isset($_SESSION['usr_id'])=="") {
  			header("Location: index.php");
  		}

      //fetch all products
      $sql_allproducts = "SELECT * FROM products ORDER BY product_category_id,created";
      $result_allproducts = mysqli_query($con, $sql_allproducts);
      //fetch category 1
      $sql_cate1 = "SELECT * FROM products WHERE product_category_id = 1 ORDER BY created";
      $result_cate1 = mysqli_query($con, $sql_cate1);
      //fetch category 2
      $sql_cate2 = "SELECT * FROM products WHERE product_category_id = 2 ORDER BY created";
      $result_cate2 = mysqli_query($con, $sql_cate2);
      //fetch acategory 3
      $sql_cate3 = "SELECT * FROM products WHERE product_category_id = 3 ORDER BY created";
      $result_cate3 = mysqli_query($con, $sql_cate3);
      //fetch category 4
      $sql_cate4 = "SELECT * FROM products WHERE product_category_id = 4 ORDER BY created";
      $result_cate4 = mysqli_query($con, $sql_cate4);
      //fetch category 5
      $sql_cate5 = "SELECT * FROM products WHERE product_category_id = 5 ORDER BY created";
      $result_cate5 = mysqli_query($con, $sql_cate5);
      //fetch category 6
      $sql_cate6 = "SELECT * FROM products WHERE product_category_id = 6 ORDER BY created";
      $result_cate6 = mysqli_query($con, $sql_cate6);

      //fetch user info
      if(isset($_SESSION['usr_id'])) {
      $user_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
      $sql_user = "SELECT * FROM users WHERE id ="  . $user_id;
      $result_user = mysqli_query($con, $sql_user);
      $row_user = mysqli_fetch_array($result_user);
      }

      $title = "หน้าแรก";

      require 'library/core.php';
      require 'template/front/member_header.php';

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

      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="#allproducts" role="tab" data-toggle="tab" aria-selected="true">ทั้งหมด</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#cate1" role="tab" data-toggle="tab">เงินสด,เครดิตเว็บ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#cate2" role="tab" data-toggle="tab">มือถือ,Tablet</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#cate3" role="tab" data-toggle="tab">Gadget</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#cate4" role="tab" data-toggle="tab">เสื้อผ้า</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#cate5" role="tab" data-toggle="tab">พรีเมี่ยม</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#cate6" role="tab" data-toggle="tab">อื่นๆ</a>
        </li>
      </ul>
  <div class="tab-content">
    <div id="allproducts" class="tab-pane fade show active">
      <div class="row full-row" id="item-zone" >
        <?php

              while($row_allproducts = mysqli_fetch_array($result_allproducts)) {
        ?>
        <div  class="col-lg-4 col-md-6 col-sm-6 pd-item" style="margin-top:10px">
          <div class="reward">
            <a><img class="reward-img-top" src="back/product/images/<?php echo $row_allproducts['image'];?>" alt=""></a>
            <div class="reward-body">
              <h3 class="reward-title" style="text-align:center;"><a style="color:#b40006"  ><?php echo $row_allproducts['name'];?></a></h3>
              <p class="reward-text" style="text-align:center;"><?php echo $row_allproducts['detail'];?> &nbsp;</p>
              <div class="div-reward">
                <button class="btn btn-md btn-primary btn-block bt-reward" onclick="addtocart(<?php echo $row_allproducts['id']; ?>)">
       <?php echo $row_allproducts['point'];?> แต้ม
       </button>
     <p class="remain-text">
             </p>
       </div>
            </div>
          </div>
        </div>
      <?php } ?>
     </div>
   </div>
     <div id="cate1" class="tab-pane fade">
       <div class="row full-row" id="item-zone" >
         <?php

               while($row_cate1 = mysqli_fetch_array($result_cate1)) {
         ?>
         <div  class="col-lg-4 col-md-6 col-sm-6 pd-item" style="margin-top:10px">
           <div class="reward">
             <a><img class="reward-img-top" src="back/product/images/<?php echo $row_cate1['image'];?>" alt=""></a>
             <div class="reward-body">
               <h3 class="reward-title" style="text-align:center;"><a style="color:#b40006"  ><?php echo $row_cate1['name'];?></a></h3>
               <p class="reward-text" style="text-align:center;"><?php echo $row_cate1['detail'];?> &nbsp;</p>
               <div class="div-reward">
                 <button class="btn btn-md btn-primary btn-block bt-reward" onclick="addtocart(<?php echo $row_cate1['id']; ?>)">
        <?php echo $row_cate1['point'];?> แต้ม
        </button>
      <p class="remain-text">
              </p>
        </div>
             </div>
           </div>
         </div>
       <?php } ?>
       </div>
     </div>
     <div id="cate2" class="tab-pane fade">
       <div class="row full-row" id="item-zone" >
         <?php

               while($row_cate2 = mysqli_fetch_array($result_cate2)) {
         ?>
         <div  class="col-lg-4 col-md-6 col-sm-6 pd-item" style="margin-top:10px">
           <div class="reward">
             <a><img class="reward-img-top" src="back/product/images/<?php echo $row_cate2['image'];?>" alt=""></a>
             <div class="reward-body">
               <h3 class="reward-title" style="text-align:center;"><a style="color:#b40006"  ><?php echo $row_cate2['name'];?></a></h3>
               <p class="reward-text" style="text-align:center;"><?php echo $row_cate2['detail'];?> &nbsp;</p>
               <div class="div-reward">
                 <button class="btn btn-md btn-primary btn-block bt-reward" onclick="addtocart(<?php echo $row_cate2['id']; ?>)">
        <?php echo $row_cate2['point'];?> แต้ม
        </button>
      <p class="remain-text">
              </p>
        </div>
             </div>
           </div>
         </div>
       <?php } ?>
       </div>
     </div>
     <div id="cate3" class="tab-pane fade">
       <div class="row full-row" id="item-zone" >
         <?php

               while($row_cate3 = mysqli_fetch_array($result_cate3)) {
         ?>
         <div  class="col-lg-4 col-md-6 col-sm-6 pd-item" style="margin-top:10px">
           <div class="reward">
             <a><img class="reward-img-top" src="back/product/images/<?php echo $row_cate3['image'];?>" alt=""></a>
             <div class="reward-body">
               <h3 class="reward-title" style="text-align:center;"><a style="color:#b40006"  ><?php echo $row_cate3['name'];?></a></h3>
               <p class="reward-text" style="text-align:center;"><?php echo $row_cate3['detail'];?> &nbsp;</p>
               <div class="div-reward">
                 <button class="btn btn-md btn-primary btn-block bt-reward" onclick="addtocart(<?php echo $row_cate3['id']; ?>)">
        <?php echo $row_cate3['point'];?> แต้ม
        </button>
      <p class="remain-text">
              </p>
        </div>
             </div>
           </div>
         </div>
       <?php } ?>
       </div>
     </div>
     <div id="cate4" class="tab-pane fade">
       <div class="row full-row" id="item-zone" >
         <?php

               while($row_cate4 = mysqli_fetch_array($result_cate4)) {
         ?>
         <div  class="col-lg-4 col-md-6 col-sm-6 pd-item" style="margin-top:10px">
           <div class="reward">
             <a><img class="reward-img-top" src="back/product/images/<?php echo $row_cate4['image'];?>" alt=""></a>
             <div class="reward-body">
               <h3 class="reward-title" style="text-align:center;"><a style="color:#b40006"  ><?php echo $row_cate4['name'];?></a></h3>
               <p class="reward-text" style="text-align:center;"><?php echo $row_cate4['detail'];?> &nbsp;</p>
               <div class="div-reward">
                 <button class="btn btn-md btn-primary btn-block bt-reward" onclick="addtocart(<?php echo $row_cate4['id']; ?>)">
        <?php echo $row_cate4['point'];?> แต้ม
        </button>
      <p class="remain-text">
              </p>
        </div>
             </div>
           </div>
         </div>
       <?php } ?>
       </div>
     </div>
     <div id="cate5" class="tab-pane fade">
       <div class="row full-row" id="item-zone" >
         <?php

               while($row_cate5 = mysqli_fetch_array($result_cate5)) {
         ?>
         <div  class="col-lg-4 col-md-6 col-sm-6 pd-item" style="margin-top:10px">
           <div class="reward">
             <a><img class="reward-img-top" src="back/product/images/<?php echo $row_cate5['image'];?>" alt=""></a>
             <div class="reward-body">
               <h3 class="reward-title" style="text-align:center;"><a style="color:#b40006"  ><?php echo $row_cate5['name'];?></a></h3>
               <p class="reward-text" style="text-align:center;"><?php echo $row_cate5['detail'];?> &nbsp;</p>
               <div class="div-reward">
                 <button class="btn btn-md btn-primary btn-block bt-reward" onclick="addtocart(<?php echo $row_cate5['id']; ?>)">
        <?php echo $row_cate5['point'];?> แต้ม
        </button>
      <p class="remain-text">
              </p>
        </div>
             </div>
           </div>
         </div>
       <?php } ?>
       </div>
     </div>
     <div id="cate6" class="tab-pane fade">
       <div class="row full-row" id="item-zone" >
         <?php

               while($row_cate6 = mysqli_fetch_array($result_cate6)) {
         ?>
         <div  class="col-lg-4 col-md-6 col-sm-6 pd-item" style="margin-top:10px">
           <div class="reward">
             <a><img class="reward-img-top" src="back/product/images/<?php echo $row_cate6['image'];?>" alt=""></a>
             <div class="reward-body">
               <h3 class="reward-title" style="text-align:center;"><a style="color:#b40006"  ><?php echo $row_cate6['name'];?></a></h3>
               <p class="reward-text" style="text-align:center;"><?php echo $row_cate6['detail'];?> &nbsp;</p>
               <div class="div-reward">
                 <button class="btn btn-md btn-primary btn-block bt-reward" onclick="addtocart(<?php echo $row_cate6['id']; ?>)">
        <?php echo $row_cate6['point'];?> แต้ม
        </button>
      <p class="remain-text">
              </p>
        </div>
             </div>
           </div>
         </div>
       <?php } ?>
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
     function addtocart(id) {
         if (confirm('เพิ่มลงในตะกร้าสินค้า?')) {
             window.location.href = 'cart.php?id=' + id + '&act=add';
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
