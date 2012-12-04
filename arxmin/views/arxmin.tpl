<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7" lang="fr" dir="ltr"><![endif]-->
<!--[if lt IE 7]><html class="ie6" lang="fr" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="ie7" lang="fr" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="ie8" lang="fr" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="fr" dir="ltr"><!--<![endif]-->
<head>
	<meta charset="UTF-8" />
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" /><![endif]-->
	<!--[if lt IE 7]><meta http-equiv="imagetoolbar" content="false" /><![endif]-->
	
	<title>ARX / Administration</title>

	<link rel="stylesheet" href="<?= ARX_CSS ?>/arx.css?v=1" />
	
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body id="arx">

	<div class="container">
		
		
		<section id="sidebar">
			<div class="top-bar">
				<h1><a class="arx-logo" href="#"><?= $this->title ?><small><em></em></small></a></h1>
				<nav>
					<a class="arx-back" href="#back"><i class="ico-white ico-chevron-left"></i></a>
				</nav>
			</div><!--/ .top-bar -->
			
			<div id="arx-menu">
				<ul>
				<?php
					foreach($this->sidemenu as $key=>$m)
					{
						echo $m;
					}
				?>
				</ul>

			</div><!--/ #arx-menu -->

			<div class="bottom-bar">
				<a class="pull-left" href="../" rel="external tooltip"><i class="icon-share-alt"></i> Go to website</a>

				<a class="pull-right" href="?logout" title="Logout" rel="tooltip" data-placement="left"><i class="icon-off"></i></a>
			</div><!--/ .bottom-bar -->
		</section><!--/ #sidebar -->
			
			
		<section id="content">

			<div class="inner">

				<iframe class="scrollable" src="<?= ( !empty($_GET['path']) ) ? $_GET['path'] : $this->apps[0]['path'] ?>" width="100%" height="100%" frameborder="0" id="iframe-app"></iframe><!--/ #iframe-app -->

			</div><!--/ .inner -->

		</section><!--/ #content -->
		
		
	</div><!--/ .container -->



	<div class="modal hide fade" id="arx-modal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Modal box</h3>
		</div>
		<div class="modal-body">
			<iframe src="" width="100%" height="100%" frameborder="0" name="iframe-modal" id="iframe-modal"></iframe>
		</div>
	</div><!--/ #arx-modal -->
	
	

	<script src="<?= ARX_JS ?>/arx.min.js"></script>
	<script>
	$(function () {
		$('[rel="tooltip"]').tooltip();
	});
	</script>
</body>
</html>