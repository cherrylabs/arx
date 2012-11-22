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

	<!--BASE href="<?= u::getURLPath() ?>"-->
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css?v=1" />
	<link rel="stylesheet" href="css/powa.css?v=1" />
	<!--link rel="stylesheet" href="css/jquery.scroll.css?v=1" /-->
	
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>

	<div class="container">
		
		
		<section class="arx-sidebar">
			<header>
				<h1><a class="arx-logo" href="#"><?= $this->title ?><small><em></em></small></a></h1>
				<nav>
					<a class="arx-back" href="#back"><i class="ico-white ico-chevron-left"></i></a>
				</nav>
			</header>
			
			<div class="arx-list">
				<ul class="arx-sortable">
				<?php
					foreach($this->sidemenu as $key=>$m)
					{
						echo $m;
					}
				?>
				</ul><!--/.arx-list -->

			</div><!--/.arx-sortable -->
		</section><!--/.arx-sidebar -->
			
			
		<section class="arx-content">

			<nav class="app-menu clearfix">
				<ul class="left clearfix">
					<li>
						<a class="fullwidth" href="../" rel="external"><i class="icon-share-alt"></i> Go to the website</a>
					</li>
				</ul>

				<ul class="right clearfix">
					<li>
						<a href="#"><i class="icon-calendar"></i><b class="app-notification">0</b></a>
					</li>
					<li>
						<a  href="#myModal" role="button" class="arx-popup" data-footer="" data-header="" data-href="" data-toggle="modal"><i class="icon-wrench"></i></a>
					</li>
					<li>
						<a class="fullwidth" href="?logout" title="Logout"><i class="icon-off"></i> 
						<?= __('Hello ') . $this->user->firstname ?></a>
					</li>
				</ul>
			</nav><!--/.app-menu -->

			<div class="app-content">

				<div class="this-app">
					<iframe class="iframe-app scrollable" src="<?= ( !empty($_GET['path']) ) ? $_GET['path'] : $this->apps[0]['path'] ?>" width="100%" height="100%" frameborder="0">
					</iframe>
				</div><!--/.this-app -->

			</div><!--/.app-content -->

			<footer>
				<span></span>
			</footer>

		</section><!--/.arx-content -->
		
		
	</div>
	
	<!-- ARX MODAL ELEMENT -->
	
	<div class="modal hide fade">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Modal header</h3>
		</div>
		<div class="modal-body">
			<p>One fine body…</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	
	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6. - chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7]>
	<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
	<script src="js/bootstrap.min.js"></script>
	<script src="<?= LIBS_JS ?>js/bootstrap.min.js"></script>
	<script>
	function resize(minHeight, minWidth){
		var max = {w: $(window).width(), h: $(window).height()}, sidebar = $('.arx-sidebar').outerWidth()
		
		$('.arx-content').css({
			//height: (max.h >= s.min.h) ? max.h : s.min.h
			width: (max.w - sidebar >= minWidth - sidebar) ? max.w - sidebar - 1 : minWidth - sidebar - 1
		})
		
		$('.iframe-app').css({
			height: (max.h >= minHeight) ? max.h - 55 : minHeight - 55,
			width: (max.w - sidebar >= minWidth - sidebar) ? max.w - sidebar - 1 : minWidth - sidebar - 1
		})
	} // resize

	$(function(){
		$('a[href^="external"]').attr('target', '_blank')

		$(window).bind('resize.powa', function(){
			resize.call(this, 400, 600)
		}).trigger('resize')
	})
	</script>
</body>
</html>