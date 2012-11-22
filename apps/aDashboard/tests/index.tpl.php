<!doctype html>
<!--[if lt IE 7 ]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?= $this->title ?></title>

	<BASE href="<?= u::getURLPath() ?>">
	<?php
		if( isset( $this->meta ) )
		{
			foreach ( $this->meta as $key => $m )
				echo '<meta name="' . $key . '" content="' . $m . '">' . "\n\t";
		}
	?>

	<link rel="stylesheet" href="css/bootstrap.min.css?v=1" />
	<link rel="stylesheet" href="css/style.css?v=1" />

	<!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body id="<?= $this->lang ?>">
<?= $this->test('dan'); ?>
</body>
</html>