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
	
	<title></title>
	
	<meta name="author" content="Stéphan Zych" />
	<meta name="Copyright" content="" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	
	<link rel="shortcut icon" href="img/favicon.ico" />
	<link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
	
	<link rel="stylesheet" href="css/style.css?v=1" />
	<!--[if lte IE 8]><link rel="stylesheet" href="css/style-ie.css" /><![endif]-->
	
	<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
	
	<div class="container-fluid">

		<div class="navbar navbar-fixed-top" id="menu">
			<div class="navbar-inner">

				<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<!-- Be sure to leave the brand out there if you want it shown -->
				<a class="brand" href="#">Project name</a>

				<!-- Everything you want hidden at 940px or less, place within here -->
				<div class="nav-collapse">
					<!-- .nav, .navbar-search, .navbar-form, etc -->
					<ul class="nav">
						<li class="active">
							<a href="#dashboard"><i class="icon-home"></i> Dashboard</a>
						</li>
						<li>
							<a href="#contact-form"><i class="icon-envelope"></i> Contact Form <span class="notif" title="2 new messages" data-placement="bottom" rel="tooltip">2</span></a>
						</li>
					</ul>

					<form class="navbar-search pull-right">
						<input type="text" class="search-query" placeholder="Search" value="" />
					</form>
				</div>

			</div>
		</div>
<?php
// predie($this->sidemenu);
?>
		<div class="row-fluid">
			<div id="sidebar">
				<a href="#sidebar" class="toggle"><i class="icon-arrow-left"></i><i class="icon-arrow-right"></i></a>
				<ul class="nav">
					<?php
					$menuItem = '<li>
						<a href="{path}">{image} {name} <span class="notif hide" title="" data-placement="bottom" rel="tooltip">{notification}</span></a>

						<div class="ui">
							<a href="#favori"><i class="icon-star"></i></a>
							<a href="#settings"><i class="icon-cogs"></i></a>
						</div>
					</li>';

					$menuItemSubmenu = '<li>
						<a href="{path}">{image} {name} <span class="notif hide" title="" data-placement="bottom" rel="tooltip">{notification}</span></a>

						<div class="ui">
							<a href="#favori"><i class="icon-star"></i></a>
							<a href="#settings"><i class="icon-cogs"></i></a>
						</div>
					</li>';

					foreach ($this->sidemenu as $key => $value) {
						if (isset($value['submenu'])) {
							echo u::strtr($menuItemSubmenu, $value);
						} else {
							echo u::strtr($menuItem, $value);
						}
					}
					?>
					<li>
						<div class="accordion" id="id-parent">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#id" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#id-parent"><i class="icon-magic"></i> Application</a>

									<div class="ui">
										<i class="icon-caret-down"></i>
									</div>
								</div>
								<div class="accordion-body collapse in" id="id">
									<div class="accordion-inner">
										<ul class="nav">
											<li>
												<a href="{path}"><i class="icon-group"></i> Users <span class="notif hide" title="" data-placement="bottom" rel="tooltip">{notification}</span></a>

												<div class="ui">
													<a href="#favori"><i class="icon-star"></i></a>
													<a href="#settings"><i class="icon-cogs"></i></a>
												</div>
											</li>
											<li>
												<a href="{path}"><i class="icon-envelope"></i> Messages <span class="notif hide" title="" data-placement="bottom" rel="tooltip">{notification}</span></a>

												<div class="ui">
													<a href="#favori"><i class="icon-star"></i></a>
													<a href="#settings"><i class="icon-cogs"></i></a>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<a href="#appmenu" rel="tooltipmenu"><i class="icon-magic"></i> DataManager <span class="notif hide" title="" data-placement="bottom" rel="tooltip">0</span></a></a>

						<ul id="appmenu">
							<li>
								<a href="#test"><i class="icon-bell"></i></a>
							</li>
							<li>
								<a href="#test"><i class="icon-star"></i></a>
							</li>
							<li>
								<a href="#test"><i class="icon-cogs"></i></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div id="application">
				<!-- <iframe class="scrollable" src="<?= ( !empty($_GET['path']) ) ? $_GET['path'] : $this->apps[0]['path'] ?>" width="100%" height="100%" frameborder="0" id="iframe-app"></iframe> -->
				<iframe class="scrollable" src="/apps/DataManager" width="100%" height="100%" frameborder="0" id="iframe-app"></iframe>
			</div>
		</div>

	</div><!--/ .container -->
	
	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6. - chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7]>
	<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
	
	<script src="js/lib/jquery.min.js"></script>
	<script src="js/lib/bootstrap.min.js"></script>
	<script src="js/lib/bootstrap-tooltipmenu.min.js"></script>
	<script src="js/script.min.js"></script>
	
</body>
</html>