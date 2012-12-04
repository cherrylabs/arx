<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7" lang="fr" dir="ltr"><![endif]-->
<!--[if lt IE 7]><html class="ie6" lang="fr" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="ie7" lang="fr" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="ie8" lang="fr" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="<?= ZE_LANG ?>" dir="ltr"><!--<![endif]-->
<head>
	<meta charset="UTF-8" />
	<?= $this->_head ?>
	<?= $this->_css ?>
<?= c_hook::output('css') ?>
</head>
<body <?= $this->_body->attr ?>>
	
	<div class="container-fluid">
	<ul class="nav nav-tabs" id="myTab">
		<?php
			foreach($this->aMenu as $key=>$v){
					
			}
		?>
	</ul>
	 
	<div class="tab-content">
		<div class="tab-pane active" id="iframe">

		</div>
		<div class="tab-pane" id="add">

		</div>
		<div class="tab-pane" id="settings">
		<?php
		
		?>
		</div>
	</div>
	
		<?php
			
		?>
		
		<?= $this->_body ?>
	</div>
<?= c_hook::output('js') ?>
<script type="text/javascript">
$(function () {

	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	})

	$('#myTab a:first').tab('show');
	
})
</script>
</body>
</html>