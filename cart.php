<?php session_start();
      include_once 'dbconnect.php';

      if(isset($_SESSION['usr_id'])=="") {
  			header("Location: index.php");
  		}

      $p_id = mysqli_real_escape_string($con, $_REQUEST['id']);
      $act = mysqli_real_escape_string($con, $_REQUEST['act']);

    	if($act=='add' && !empty($p_id))
    	{
    		if(isset($_SESSION['cart'][$p_id]))
    		{
    			$_SESSION['cart'][$p_id]++;
          header("Location: cart.php");
    		}
    		else
    		{
    			$_SESSION['cart'][$p_id]=1;
          header("Location: cart.php");
    		}
    	}

    	if($act=='remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
    	{
    		unset($_SESSION['cart'][$p_id]);
        header("Location: cart.php");
    	}

    	if($act=='update')
    	{
    		$amount_array = $_POST['amount'];
    		foreach($amount_array as $p_id=>$amount)
    		{
    			$_SESSION['cart'][$p_id]=$amount;
          header("Location: cart.php");
    		}
    	}

      //fetch user info
      if(isset($_SESSION['usr_id'])) {
      $user_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
      $sql_user = "SELECT * FROM users WHERE id ="  . $user_id;
      $result_user = mysqli_query($con, $sql_user);
      $row_user = mysqli_fetch_array($result_user);
      }

      $title = "ตะกร้าสินค้า";

      require 'library/core.php';
      require 'template/front/member_header.php';

?>

      <!-- Page Body -->
      <div class="row login-zone" >
        <div class="col-lg-6" style="background-color:#f9f9f9; vertical-align: middle; padding:10px " id="loginzone">
		    <h1><strong><?php echo $row_user['firstname'] ?> <?php echo $row_user['lastname'] ?></strong></h1>
        <div style="">
            <br />
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

        </div>
        </div>

		</div>
    <div class="container-fluid">
      <div class="row">
          <div class="col">
              <h2>ตะกร้าสินค้า</h2>
          </div>
          <div class="col">
              <h2 style="color: #2f5caa; text-align:center;">แต้มที่มี: <strong><?php echo $row_user['own_point'];?></strong></h2>
          </div>
      </div>
               <div class="table-responsive" style="margin-top:17px;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width='400'>สินค้า</th>
                            <th style="text-align:right;">แต้มที่ใช้</th>
                            <th style="text-align:right;">จำนวน</th>
                            <th style="text-align:right;">รวม(แต้ม)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total=0;
                          if(!empty($_SESSION['cart']))
                          {
                        	foreach($_SESSION['cart'] as $p_id=>$qty)
                        	{
                      		$sql = "SELECT * FROM products WHERE id=$p_id";
                      		$query = mysqli_query($con, $sql);
                      		$row = mysqli_fetch_array($query);
                      		$sum = $row['point'] * $qty;
                      		$total += $sum;
                        ?>
                        <form id="frmcart" name="frmcart" method="post" action="?act=update">
                        <tr>
                            <td width='400'><?php echo $row['name']; ?></td>
                            <td style="text-align:right;"><?php echo $row['point']; ?></td>
                            <td style="text-align:right;"><input type='number' min="1" name='amount[<?php echo $p_id;?>]' value='<?php echo $qty; ?>'style="text-align:right;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength = "3"/></td>
                            <td style="text-align:right;"><?php echo $sum; ?></td>
                            <td style="text-align:center;">
                            <button type="button" name="delete" class="btn btn-danger btn-sm" onclick="remove_product(<?php echo $row['id']; ?>)"><i class="fas fa-trash-alt"></i> ลบ</button>
                            </td>
                        </tr>
                        <?php }} ?>
                        <tr>
                        <th colspan="2" style="text-align:center;">รวมทั้งหมด</th>
                        <th style="text-align:right;"><input type="submit" class="btn btn-info btn-sm" name="button" id="button" value="คำนวณแต้มทั้งหมดใหม่" /></th>
                        <th style="text-align:right;"><?php echo $total;?></th>
                        <th></th>
                        </tr>
                      </form>
                        <?php if($row_user['own_point']>=$total && $total>"0" ) { ?>
                            <tr>
                            <th colspan="4" style="text-align:right;">
                            </th>
                            <th></th>
                          </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="container">
                    <div class=" row justify-content-center">
                      <div class="card bg-light" style="margin-top:20px; margin-left:20px;">
                        <div class="card-header">
                          <h5 style="text-align:center;">กรุณากรอกที่อยู่สำหรับส่งสินค้า</h5>
                          <h5 style="text-align:center; color:red;">ไม่ต้องกรอกที่อยู่ถ้าเลือกสินค้าเป็นเงินสดหรือเครดิตเว็บ</h5>
                        </div>
                        <div class="card-body">
                        <form role="form" action="<?php echo $baseUrl ?>/confirm.php" method="post" name="addressform">
                          <fieldset>
                            <div class="row">
                             <div class="form-group col-6">
                              <label for="name" class="font-weight-bold">เบอร์โทรศัพท์*</label>
                              <input type="text" name="phone" placeholder="เบอร์โทรศัพท์" required class="form-control" OnKeyPress="return chkNumber(this)" />
                              <input type="hidden" name="total_point" value="<?php echo $total ?>"  />
                            </div>

                            <div class="form-group col-6">
                             <label for="name" class="font-weight-bold">ไอดีไลน์*</label>
                             <input type="text" name="lineid" placeholder="ไอดีไลน์" required class="form-control"  />
                           </div>
                          </div>

                            <div class="row">
                            <div class="form-group col-6">
                             <label for="name" class="font-weight-bold">ยูสเซอร์เนม / Username*</label>
                             <input type="text" name="ins_username" placeholder="ยูสเซอร์เนม / Username" disabled required class="form-control" value="<?php echo $row_user['username'];?>"  />
                           </div>
                          </div>

                          <div class="border-top my-3"></div>

                            <div class="form-group">
                              <label for="name" class="font-weight-bold">ที่อยู่</label>
                              <input type="text" name="address" placeholder="ที่อยู่" class="form-control" />
                            </div>

                          <div class="row">
                           <div class="form-group col-6">
                            <label for="name" class="font-weight-bold">แขวง/ตำบล เขต/อำเภอ</label>
                            <input type="text" name="district" placeholder="แขวง/ตำบล เขต/อำเภอ" class="form-control"  />
                          </div>

                            <div class="form-group col-6">
                              <label for="name" class="font-weight-bold">จังหวัด</label>
                              <input type="text" name="province" placeholder="จังหวัด" class="form-control" />
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-6">
                              <label for="name" class="font-weight-bold">รหัสไปรษณีย์</label>
                              <input type="text" name="zipcode" placeholder="รหัสไปรษณีย์" class="form-control" OnKeyPress="return chkNumber(this)" maxlength="5" />
                            </div>

                            <div class="form-group col-6">
                              <label for="name" class="font-weight-bold">ประเทศ</label>
                              <input type="text" name="country" placeholder="ประเทศ" class="form-control" value="ไทย"/>
                            </div>
                          </div>
                            <div class="form-group">
                              <button type="submit" name="submit" class="btn btn-primary btn-md"><i class="fas fa-check-circle"></i> ยืนยัน</button>
                            </div>
                          </fieldset>
                        </form>
                        <span class="text-danger"><?php if (isset($_SESSION['order_error'])) { echo $_SESSION['order_error'];
                                                            unset($_SESSION['order_error']); } ?></span>
                      </div>
                  </div>
                </div>
              </div>
                        <?php } elseif($total=="0") { ?>
                        <tr>
                          <th colspan="4" style="text-align:right;">
                              <input type="button" class="btn btn-danger btn-md" value="ไม่มีสินค้าในตะกร้า" />
                          </th>
                          <th></th>
                        </tbody>
                    </table>
                  </div>
               </div>
                        <?php } else { ?>
                          <tr>
                            <th colspan="4" style="text-align:right;">
                                <input type="button" class="btn btn-danger btn-md" value="แต้มไม่เพียงพอ" />
                            </th>
                            <th></th>
                          </tbody>
                      </table>
                    </div>
                 </div>
                        <?php } ?>

  <script>
  function remove_product(id) {
     window.location.href = 'cart.php?id=' + id + '&act=remove';
  }
  function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
	}
  </script>
	<!-- END Page Body -->
  <?php
  require 'template/front/footer.php';
  ?>
