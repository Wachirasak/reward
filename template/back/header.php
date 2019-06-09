<?php

		  if(isset($_SESSION['admin_id']) == "") {
			header("Location: ../../back/home/admin_login.php");
			}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Sarabun" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
			<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/back.css">

			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
			<title><?php echo $title; ?></title>
    </head>

    <body>
      <div class="d-flex" id="wrapper">
         <!-- Sidebar -->
         <div class="bg-light border-right" id="sidebar-wrapper">
           <div class="sidebar-heading">ADMIN</div>
           <div class="list-group list-group-flush">
             <a href="<?php echo $baseUrl; ?>/back/home" class="list-group-item list-group-item-action bg-light"><i class="fas fa-home "></i>&nbsp;หน้าแรก</a>
             <a href="<?php echo $baseUrl; ?>/back/user" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users"></i>&nbsp;ผู้ใช้ (user)</a>
						 <a href="<?php echo $baseUrl; ?>/back/order" class="list-group-item list-group-item-action bg-light"><i class="fas fa-shopping-cart"></i>&nbsp;รายการขอแลก</a>
             <a href="<?php echo $baseUrl; ?>/back/productcategories" class="list-group-item list-group-item-action bg-light"><i class="far fa-list-alt"></i>&nbsp;หมวดหมู่สินค้า</a>
             <a href="<?php echo $baseUrl; ?>/back/product" class="list-group-item list-group-item-action bg-light"><i class="fas fa-list-ul"></i>&nbsp;สินค้า</a>
             <a href="<?php echo $baseUrl; ?>/back/promotion" class="list-group-item list-group-item-action bg-light"><i class="fab fa-product-hunt"></i>&nbsp;โปรโมชัน</a>
						 <a></a>
           </div>
         </div>
         <!-- /#sidebar-wrapper -->
         <!-- Page Content -->
            <div id="page-content-wrapper">

              <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary btn-sm" id="menu-toggle">เปิด/ปิดเมนู</button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php echo $_SESSION['admin_usrname']; ?>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo $baseUrl ?>/back/home/admin_logout.php">ออกจากระบบ</a>
                      </div>
                    </li>
                  </ul>
                </div>
              </nav>
