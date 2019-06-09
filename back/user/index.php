<?php session_start();
    include_once '../../dbconnect.php';

    // fetch records
   if(isset($_GET['keyword']) != "") {
     $perpage = 2147493647;
   } else {
     $perpage = 20;

   }

   if (isset($_GET['page'])) {
   $page = $_GET['page'];
   } else {
   $page = 1;
   }

   $start = ($page - 1) * $perpage;


    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);

$title = "จัดการผู้ใช้";

require '../../library/core.php';
require '../../template/back/header.php';
require '../../template/back/thaidate.php';

?>

<div class="container-fluid">
  <h2 class="mt-1">จัดการผู้ใช้</h2>
  <button name="adduser" class="btn btn-success btn-sm" onclick="add_user()"><i class="fas fa-plus-circle"></i> เพิ่มผู้ใช้</button>
  <form style="margin-top:10px;" id="form_search" name="form_search" method="get" action="">
  <input type="text" name="keyword" id="keyword" />
  <input type="submit" id="button" value="ค้นหา" />
  </form>
  <div id="all_users">
    <div class="card" style="margin-top:1rem;">
           <div class="table-responsive" >
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>Username</th>
                        <th>โทรศัพท์</th>
                        <th>แต้มที่มี</th>
                        <th>วันที่สร้าง</th>
                        <th colspan="2" style="text-align:center"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  if(isset($_GET['keyword']) && $_GET['keyword']!=""){
                    $sql.=" WHERE (username LIKE '%".trim($_GET["keyword"])."%' or firstname LIKE '%"
                          .trim($_GET["keyword"])."%' or lastname LIKE '%".trim($_GET["keyword"])."%' )";
                    }
                    $sql .= " LIMIT $start , $perpage  ";
                    $result = mysqli_query($con, $sql);
                    $cnt = 1;
                    while($row = mysqli_fetch_array($result)) { ?>
                    <tr id='<?php echo $row['id']; ?>'>
                        <td><?php echo $cnt++; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['own_point']; ?></td>
                        <td><?php echo thaidate($row['created']); ?></td>
                        <td>
                        <button name="add_point" class="btn btn-info btn-sm" onclick="add_point(<?php echo $row['id']; ?>)"><i class="fas fa-coins"></i> เพิ่มแต้ม</button>
                        <button name="minus_point" class="btn btn-info btn-sm" onclick="minus_point(<?php echo $row['id']; ?>)"><i class="fas fa-coins"></i> ลดแต้ม</button>
                        <button name="point_history" class="btn btn-secondary btn-sm" onclick="point_history(<?php echo $row['id']; ?>)"><i class="fas fa-info"></i> ประวัติแต้ม</button>
                        <button name="edit" class="btn btn-secondary btn-sm" onclick="edit_user(<?php echo $row['id']; ?>)"><i class="fas fa-pencil-alt"></i> แก้ไข</button>
                        <button name="delete" class="btn btn-danger btn-sm" id="delete" data-id="<?php echo $row['id']; ?>" href="javascript:void(0)"><i class="fas fa-trash-alt"></i> ลบ</button>

                        </td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
           </div>
         </div>
         </div>
            <?php
            $sql2 = "SELECT * FROM users ";
            $result2 = mysqli_query($con, $sql2);
            $total_record = mysqli_num_rows($result2);
            $total_page = ceil($total_record / $perpage);
            ?>
            <?php if(isset($_GET['keyword']) == "") {
              $perpage = 200; ?>

            <nav >
             <ul class="pagination" style="margin-top:1rem;>
             <li class="page-item">
             <a class="page-link" href="index.php?page=1" aria-label="Previous">
             <span aria-hidden="true">&laquo;</span>
             </a>
             </li>
             <?php for($i=1;$i<=$total_page;$i++){ ?>
             <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
             <?php } ?>
             <li class="page-item" >
             <a class="page-link" href="index.php?page=<?php echo $total_page;?>" aria-label="Next">
             <span aria-hidden="true">&raquo;</span>
             </a>
             </li>
             </ul>
             </nav>
           <?php } ?>
        </div>
    </div>
</div>

<script>
    function edit_user(id) {
       window.location.href = 'edit/' + id;
    }
    function point_history(id) {
       window.location.href = 'point_history/' + id;
    }
   function add_point(id) {
      window.location.href = 'add_point/' + id;
   }
   function minus_point(id) {
      window.location.href = 'minus_point/' + id;
   }
   function add_user() {
      window.location.href = 'create.php';
   }

   $(document).ready(function(){

      updateUsers();

   		$(document).on('click', '#delete', function(e){

   			var userId = $(this).data('id');
   			SwalDelete(userId);
   			e.preventDefault();
   		});

   	});

   	function SwalDelete(userId){

   		Swal.fire({
   			title: 'ลบผู้ใช้ ?',
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
   			      data: 'id='+userId,
   			      dataType: 'json'
   			     })
   			     .done(function(response){
   			     	Swal.fire('ลบแล้ว!', response.message, response.status);
              updateUsers();
   			     })
   			     .fail(function(){
   			     	Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
   			     });
   			  });
   		    },

   			allowOutsideClick: false
   		});
   	}
    function updateUsers() {
    $('#all_users').load(document.URL +  ' #all_users');    }
</script>

<?php
require '../../template/back/footer.php';
?>
