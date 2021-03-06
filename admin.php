<?php
	require_once('/var/www/config.php');
	sro('/Includes/mysql.php');
	sro('/Includes/session.php');
	sro('/Includes/functions.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<?php sro('/Includes/head.php'); ?>
		<title>Admin | Latin</title>
		<?php sro('/Includes/css.php'); ?>
		<link rel="stylesheet" type="text/css" href="/CSS/admin.css">
		<?php sro('/Includes/js.php'); ?>
		<script type="text/javascript" src="/JS/admin.js"></script>
	</head>
	<body>
		<?php sro('/Includes/header.php'); ?>
		<div class="column-right width-eighty mobile-width-full no-mobile-margin no-mobile-padding" id="content-wrapper">
	        <section class="no-mobile-margin" id="content">
				<?php sro('/Pages/admin.php'); ?>
			</section>
			<?php sro('/Includes/footer.php'); ?>
		</div>
	</body>
</html>
