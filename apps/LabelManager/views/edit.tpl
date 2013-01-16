<?php
/** ARX - aLabelManager
 * PHP File - /apps/aLabelManger/views/edit.tpl
 */

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<meta charset="UTF-8" />

	<title></title>
	
	<?= c_hook::output('css') ?>
	
	<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
	
	<div class="container">

		<div style="width: 100%;">
			<form action="" method="POST" accept-charset="utf-8">
				<textarea name="value" cols="50" rows="10"><?= $this->value ?></textarea>
				<br/>

				<div class="clearfix">
					<button class="btn btn-success pull-right" type="submit"><i class="icon-save"></i> Update</button>
				</div>
			</form>
		</div>
		
	</div><!--/ .container -->

	<?= c_hook::output('js') ?>
	
</body>
</html>
