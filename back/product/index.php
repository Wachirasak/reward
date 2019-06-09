<?php session_start();
    include_once '../../dbconnect.php';

    // fetch records
    $sql = "SELECT *,products.id as pid, products.name as pname , product_categories.name as cname FROM products
            INNER JOIN product_categories ON	products.product_category_id = product_categories.id ORDER BY product_categories.id,products.created" ;
    $result = mysqli_query($con, $sql);

    // fetch หมวดหมู่
    $sql2 = "SELECT * FROM product_categories order by id";
    $result2 = mysqli_query($con, $sql2);

$title = "จัดการสินค้า";

require '../../library/core.php';
require '../../template/back/header.php';
require '../../template/back/thaidate.php';

?>

<div class="container-fluid">
  <h2 class="mt-1">จัดการสินค้า</h2>
  <div class="row justify-content-between">
  <div class="col-4">
  <button name="adduser" class="btn btn-success btn-sm" onclick="add_product()"><i class="fas fa-plus-circle"></i> เพิ่มสินค้า</button>
  </div>
  <!--<div class="col-3">
  <select name="product_category_id" class="form-control input-sm float-right">
                  <option value="1">ทั้งหมด</option>
            <?php //while($row2 = mysqli_fetch_array($result2)) { ?>
                  <option value="<?php //echo $row2['id']; ?>"><?php //echo $row2['name']; ?></option>
                <?php //} ?>
            </select>
      </div>-->
  </div>

  <div id="all_products">
  <div class="card" style="margin-top:1rem;">
           <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อสินค้า</th>
                        <th>รายละเอียด</th>
                        <th>รูป</th>
                        <th>แต้มที่ใช้แลก</th>
                        <th>หมวดหมู่</th>
                        <th>วันที่สร้าง</th>
                        <th colspan="2" style="text-align:center"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $cnt = 1;
                    while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $cnt++; ?></td>
                        <td><?php echo $row['pname']; ?></td>
                        <td><?php echo $row['detail']; ?></td>
                        <td><img src="images/<?php echo $row['image'];?>" height="100rem"</td>
                        <td><?php echo $row['point']; ?></td>
                        <td><?php echo $row['cname']; ?></td>
                        <td><?php echo thaidate($row['created']); ?></td>
                        <td>
                        <button name="detail" class="btn btn-secondary btn-sm" onclick="edit_product(<?php echo $row['pid']; ?>)"><i class="fas fa-pencil-alt"></i> แก้ไข</button>
                        <button name="delete" class="btn btn-danger btn-sm" id="delete" data-id="<?php echo $row['pid']; ?>" href="javascript:void(0)"><i class="fas fa-trash-alt"></i> ลบ</button>
                        </td>
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
    </div>
</div>

<script>
   function add_product() {
      window.location.href = 'create.php';
   }
   function edit_product(pid) {
      window.location.href = 'edit/' + pid;
   }
   $(document).ready(function(){

      updateProducts();

       $(document).on('click', '#delete', function(e){

         var productId = $(this).data('id');
         SwalDelete(productId);
         e.preventDefault();
       });

     });

     function SwalDelete(productId){

       Swal.fire({
         title: 'ลบสินค้า ?',
         text: "จะเป็นการลบแบบถาวร ยืนยันหรือไม่?!",
         type: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#d33',
         cancelButtonColor: '#858585',
         confirmButtonText: 'ใช่ ยืนยัน',
        cancelButtonText: 'ยกเลิก',
         showLoaderOnConfirm: true,
        reverseButtons: true,

         preConfirm: function() {
           return new Promise(function(resolve) {

              $.ajax({
               url: 'delete.php',
               type: 'POST',
               data: 'id='+productId,
               dataType: 'json'
              })
              .done(function(response){
               Swal.fire('ลบแล้ว!', response.message, response.status);
              updateProducts();
              })
              .fail(function(){
               Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
              });
           });
           },

         allowOutsideClick: false
       });
     }
    function updateProducts() {
    $('#all_products').load(document.URL +  ' #all_products');    }
</script>

<?php
require '../../template/back/footer.php';
?>
