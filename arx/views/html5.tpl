<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7" lang="fr" dir="ltr"><![endif]-->
<!--[if lt IE 7]><html class="ie6" lang="fr" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="ie7" lang="fr" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="ie8" lang="fr" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="<?php echo ZE_LANG ?>" dir="ltr"><!--<![endif]-->
<head>
	<meta charset="UTF-8" />
	<?php echo $this->_head ?>
	<?php echo $this->_css ?>
<?php echo c_hook::output('css') ?>
</head>
<body <?php echo $this->_body->attr ?>>
	
	<div class="container">
		<?php echo $this->_body ?>
	</div>
<?php echo c_hook::output('js') ?>
</body>
</html>