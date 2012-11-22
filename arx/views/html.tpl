<!doctype html>
<!--[if lt IE 7 ]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<BASE href="<?= u::getURLPath() ?>">
	<?= $this->_css; ?>
	<?= $this->_head; ?>
</head>
<body <?= c_html::attributes($this->_body->_attributes) ?>>
	<?= $this->_body ?>
	<?= $this->_js ?>
</body>
</html>