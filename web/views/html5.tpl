<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7" lang="fr" dir="ltr"><![endif]-->
<!--[if lt IE 7]><html class="ie6" lang="fr" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="ie7" lang="fr" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="ie8" lang="fr" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="<?php echo ZE_LANG ?>" dir="ltr"><!--<![endif]-->
<head>
	<meta charset="UTF-8" />
	<?php echo $this->fetch('head') ?>
	<?php echo c_hook::output('css') ?>
</head>
<body <?php if( isset($this->_body->attr) ) { echo $this->_body->attr; } ?>>
<?php echo $this->fetch('header') ?>
<div class="container<?= !($this->_mode['fluid']) ? '-fluid' : '-fluid'?>">
	<?php echo $this->_body ?>
</div>
<?php echo $this->fetch('footer') ?>
<?php echo c_hook::output('js') ?>
</body>
</html>