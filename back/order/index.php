<?php session_start();
    include_once '../../dbconnect.php';

    // fetch orders

    $sql = "SELECT *,orders.id as oid, users.firstname as fname, users.lastname as lname FROM orders INNER JOIN users ON orders.user_id = users.id ORDER BY status,oid";
    $result = mysqli_query($con, $sql);


    if (isset($_GET['id'])) {
        $sql = "DELETE FROM orders WHERE id=" . $_GET['id'];
        @mysqli_query($con, $sql);
        header("Location: index.php");
    }
$title = "รายการขอแลก";

require '../../library/core.php';
require '../../template/back/header.php';
require '../../template/back/thaidate.php';
?>

<div class="container-fluid">
  <h2 class="mt-1">รายการขอแลก</h2><button value="Refresh Page" class="btn btn-success" onClick="window.location.reload();"><i class="fas fa-sync-alt"></i> อัพเดท</button>
  <div id="all_orders">
  <div class="card" style="margin-top:1rem;">
           <div class="table-responsive ">
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อ</th>
                        <th>Username</th>
                        <th>แต้มที่ใช้</th>
                        <th>วันที่สร้าง</th>
                        <th>สถานะ</th>
                        <th colspan="2" style="text-align:center"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $cnt = 1;
                    while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['oid']; ?></td>
                        <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
                        <td><?php echo $row['ins_username']; ?></td>
                        <td><?php echo $row['total_point']; ?></td>
                        <td><?php echo thaidate($row['order_date']); ?></td>
                        <?php if($row['status'] == '1') { ?>
                          <td>รอการยืนยัน</td>
                          <td>
                            <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-pencil-alt"></i> เปลี่ยนสถานะ
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="changestatus.php?id=1&oid=<?php echo $row['oid']; ?>" >รอการยืนยัน</a>
                              <button class="dropdown-item" id="delivered" data-id="<?php echo $row['oid']; ?>" href="javascript:void(0)" style='color:blue';>จัดส่งเรียบร้อยแล้ว</button>
                              <button class="dropdown-item" id="confirm" data-id="<?php echo $row['oid']; ?>" href="javascript:void(0)"  style='color:green';>ได้รับสินค้าแล้ว</button>
                              <button class="dropdown-item" id="cancel" data-id="<?php echo $row['oid']; ?>" href="javascript:void(0)" style='color:red';>ยกเลิกแล้ว</button>

                            </div>
                          </div>
                          <button name="detail" class="btn btn-secondary btn-sm" onclick="order_details(<?php echo $row['oid']; ?> )"><i class="fas fa-info-circle"></i> รายละเอียด</button>
                          <button name="delete" class="btn btn-danger btn-sm" onclick="delete_order(<?php echo $row['oid']; ?>)"><i class="fas fa-trash-alt"></i> ลบ</button>
                          </td>
                        <?php } elseif($row['status'] == '2') { ?>
                          <td style='color:blue';>จัดส่งเรียบร้อยแล้ว</td>
                          <td>
                            <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-pencil-alt"></i> เปลี่ยนสถานะ
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="changestatus.php?id=1&oid=<?php echo $row['oid']; ?>" >รอการยืนยัน</a>
                              <button class="dropdown-item" id="delivered" data-id="<?php echo $row['oid']; ?>" href="javascript:void(0)" style='color:blue';>จัดส่งเรียบร้อยแล้ว</button>
                              <button class="dropdown-item" id="confirm" data-id="<?php echo $row['oid']; ?>" href="javascript:void(0)"  style='color:green';>ได้รับสินค้าแล้ว</button>
                              <button class="dropdown-item" id="cancel" data-id="<?php echo $row['oid']; ?>" href="javascript:void(0)" style='color:red';>ยกเลิกแล้ว</button>
                            </div>
                          </div>
                          <button name="detail" class="btn btn-secondary btn-sm" onclick="order_details(<?php echo $row['oid']; ?> )"><i class="fas fa-info-circle"></i> รายละเอียด</button>
                          <button name="delete" class="btn btn-danger btn-sm" onclick="delete_order(<?php echo $row['oid']; ?>)"><i class="fas fa-trash-alt"></i> ลบ</button>
                          </td>
                        <?php } elseif($row['status'] == '3') { ?>
                          <td style='color:green';>ได้รับสินค้าแล้ว</td>
                          <td>
                          <button name="detail" class="btn btn-secondary btn-sm" onclick="order_details(<?php echo $row['oid']; ?> )"><i class="fas fa-info-circle"></i> รายละเอียด</button>
                          <button name="delete" class="btn btn-danger btn-sm" onclick="delete_order(<?php echo $row['oid']; ?>)"><i class="fas fa-trash-alt"></i> ลบ</button>
                          </td>
                        <?php } else { ?>
                          <td style='color:red';>ยกเลิกแล้ว</td>
                          <td>
                          <button name="detail" class="btn btn-secondary btn-sm" onclick="order_details(<?php echo $row['oid']; ?> )"><i class="fas fa-info-circle"></i> รายละเอียด</button>
                          <button name="delete" class="btn btn-danger btn-sm" onclick="delete_order(<?php echo $row['oid']; ?>)"><i class="fas fa-trash-alt"></i> ลบ</button>
                          </td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
           </div>
           </div>
         </div>
           <!--12.display number of records -->
           <div class="panel-footer"><?php echo mysqli_num_rows($result) . " records found"; ?></div>
        </div>

<script>

   function delete_order(oid) {
       if (confirm('คุณยืนยันต้องการจะลบข้อมูลนี้ ใช่หรือไม่?')) {
           window.location.href = 'index.php?id=' + oid;
       }
   }
   function add_user() {
      window.location.href = 'create.php';
   }
   function order_details(id) {
      window.location.href = '' + id;
   }
   function confirm_order(id) {
       if (confirm('หากยืนยันแล้วจะเปลี่ยนสถานะไม่ได้อีก ยืนยันว่าได้รับสินค้าแล้ว ?')) {
           window.location.href = 'changestatus.php?id=3&oid=' + id;
       }
     }

       $(document).ready(function(){

          updateOrders();

       		$(document).on('click', '#cancel', function(e){
       			var orderId = $(this).data('id');
       			SwalCancel(orderId);
       			e.preventDefault();
       		});
          $(document).on('click', '#delivered', function(e){
       			var orderId2 = $(this).data('id');
       			SwalDelivered(orderId2);
       			e.preventDefault();
       		});
          $(document).on('click', '#confirm', function(e){
            var orderId3 = $(this).data('id');
            SwalConfirm(orderId3);
            e.preventDefault();
          });
       	});

        function SwalCancel(orderId){
         Swal.fire({
           title: 'ยกเลิก ?',
           html: "เมื่อยกเลิกแล้ว จะคืนแต้มให้ลูกค้าโดยอัตโนมัติ " +
                 "</br><p style='color:red;'>และจะเปลี่ยนสถานะไม่ได้อีก ยกเลิกใช่หรือไม่?!</p>",
           type: 'warning',
           input: 'text',
           inputPlaceholder: 'กรุณาใส่เหตุผลการยกเลิก',
           showCancelButton: true,
           confirmButtonColor: '#d33',
           cancelButtonColor: '#858585',
           confirmButtonText: 'ยืนยัน',
           cancelButtonText: 'ไม่',
           showLoaderOnConfirm: true,
           reverseButtons: true,
           inputValidator: (value) => {
             if (!value) {
               return 'กรุณาใส่เหตุผลการยกเลิก!'
             }
           },
           preConfirm: function(text) {
             return new Promise(function(resolve) {
                $.ajax({
                 url: 'changestatus.php',
                 type: 'GET',
                 data: 'id=4&oid='+ orderId + '&note='+ text,
                 dataType: 'json'
                })
                .done(function(response){
                 Swal.fire('ยกเลิกแล้ว!', response.message, response.status);
                updateOrders();
                })
                .fail(function(){
                 Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                 updateOrders();
                });
             });
             },

           allowOutsideClick: false
         });
       }

       function SwalDelivered(orderId2){
        Swal.fire({
          title: 'จัดส่งแล้ว ?',
          html: "กรุณาใส่เลข EMS" +
                "</br><p style='color:red;'>ไม่ต้องใส่ถ้าสินค้าเป็นเงินสดหรือเครดิตเว็บ</p>",
          type: 'warning',
          input: 'text',
          inputPlaceholder: 'เลข EMS',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#858585',
          confirmButtonText: 'ยืนยัน',
          cancelButtonText: 'ยกเลิก',
          showLoaderOnConfirm: true,
          reverseButtons: true,

          preConfirm: function(text) {
            return new Promise(function(resolve) {
               $.ajax({
                url: 'changestatus.php',
                type: 'GET',
                data: 'id=2&oid='+ orderId2 + '&note='+ text,
                dataType: 'json'
               })
               .done(function(response){
                Swal.fire('จัดส่งแล้ว!', response.message, response.status);
               updateOrders();
               })
               .fail(function(){
                Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                updateOrders();
               });
            });
            },

          allowOutsideClick: false
        });
      }

      function SwalConfirm(orderId3){
        Swal.fire({
          title: 'ลูกค้าได้รับสินค้าแล้ว ?',
          text: "หากยืนยันแล้วจะเปลี่ยนสถานะไม่ได้อีก ยืนยันหรือไม่?!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#858585',
          confirmButtonText: 'ยืนยัน',
          cancelButtonText: 'ไม่',
          showLoaderOnConfirm: true,
          reverseButtons: true,

          preConfirm: function() {
            return new Promise(function(resolve) {

               $.ajax({
                url: 'changestatus.php',
                type: 'GET',
                data: 'id=3&oid='+ orderId3,
                dataType: 'json'
               })
               .done(function(response){
                Swal.fire('ยืนยันแล้ว!', response.message, response.status);
                updateOrders();
               })
               .fail(function(){
                Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                updateOrders();
               });
            });
            },

          allowOutsideClick: false
        });
      }
      function updateOrders() {
      $('#all_orders').load(document.URL +  ' #all_orders');    }
</script>
<?php
require '../../template/back/footer.php';
?>
