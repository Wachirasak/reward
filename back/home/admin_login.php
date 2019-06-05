<?php session_start();
		require("botdetect.php");

		if(isset($_SESSION['admin_id'])!="") {
			header("Location: index.php");
		}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Sarabun" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
	<link rel="stylesheet" href="../../css/back.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <title>ADMIN LOGIN</title>
</head>
<body>


<div class="container">
	<div class="row justify-content-center" style="margin-top:75px;">
		<div class="col-md-4 col-md-offset-4 card card-body bg-light">
			<form role="form" action="login.php" method="post" name="loginform">
				<fieldset>
					<legend>Admin Login</legend>

					<div class="form-group">
						<label for="name">Username</label>
						<input type="text" name="username" placeholder="Username" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Password" required class="form-control" />
					</div>

					<div class="form-group">
					<?php // Adding BotDetect Captcha to the page
					  $ExampleCaptcha = new Captcha("ExampleCaptcha");
					  $ExampleCaptcha->UserInputID = "CaptchaCode";
					  echo $ExampleCaptcha->Html();
					?>
						<input name="CaptchaCode" id="CaptchaCode" type="text" placeholder="กรอกข้อมูลที่ปรากฎ" required class="form-control" />
					</div>

					<div class="form-group">
						<input type="submit" name="login" value="Login" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<!--8.display message -->
			<span class="text-danger"><?php if (isset($_SESSION['errormsg'])) { echo $_SESSION['errormsg'];
																					unset($_SESSION['errormsg']); } ?></span>
		</div>
	</div>
</div>
</body>
</html>
