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
	
	<?= c_load::css(array(ARX_CSS.DS.'bootstrap.css', ARX_CSS.DS.'bootstrap-responsive.css')) ?>

	<!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body id="<?= $this->lang ?>">
	<div class="app-container">
		<header id="main-header" class="wrapper"><?= lg('header_sef'); ?>
			
		</header>
		<div id="main" class="wrapper row-fluid">

			<div class="accordion span6" id="example1">
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" href="#collapseOne" data-toggle="collapse">RSS Reader</a> 
						<a class="config" href="#config" title="Configuration"><i class="icon-wrench"></i></a>
					</div>
					<div class="accordion-body collapse in" id="collapseOne">
						<div class="accordion-inner">
							<?php
								
								//$aUsers = a_db::findAll(T_USERS);
								
								$app = new arx();
								
								arx::uses('c_text');
								
								//$app->display(COMMON_VIEWS.DS.'table-crud.tpl', array("data" => $aUsers));
								
								$feeds = c_feed::parse('http://feeds.feedburner.com/colossal?xml', 4);
								
								foreach($feeds as $key=>$f)
								{
									$f = (object) $f;
									
									$html = str_get_html($f->encoded);
									
									$html->find('img', 0)->style = 'width:100px;height:100px;display:block;float:left;margin:0 10px 10px 0;';
									$html->find('img', 0)->class = 'img-polaroid';
									$html->find('img', 0)->height = "100px";
									$html->find('img', 0)->width = "100px";
									
									$image = $html->find('img', 0);
									
									echo '<div class="list-block">
											<h2>'.$f->title.'</h2>
											'.$image.'
											<p>'.$f->description.'</p>
											<hr class="clear" />
									</div>';
								}
								
							?>
						</div>
						<!--/.accordion-inner -->
					</div>
					<!--/.accordion-body -->
				</div>
			</div>
			<!--/.accordion -->
			<div class="accordion span6" id="example2">
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" href="#collapseFour" data-parent="#example2" data-toggle="collapse">Test</a> <a class="config" href="#config" title="Configuration"><i class="icon-wrench"></i></a>
					</div>
					<div class="accordion-body collapse in" id="collapseFour">
						<div class="accordion-inner accordion-full">
							
							<table class="table table-striped table-separated" id="labelsTable">
							<thead>
								<tr>
									<th>Name <i class="icon"></i></th>
									<th>Description <i class="icon"></i></th>
									<th>Size <i class="icon"></i></th>
									<th>Right <i class="icon"></i></th>
								</tr>
							</thead>
							<tbody>
							<?php
								for($i = 0; $i < 10; $i++){
								echo '<tr>
									<td><i class="icon-file"></i> '.$i.'file or folder</td>
									<td class="note">Las commit message</td>
									<td>file size</td>
									<td>Write permission / user</td>
								</tr>';
								}
							?>
							</tbody>
							</table>
						
						</div>
					</div>
				</div>
			</div><!--/.accordion -->
		</div><!--/#main -->
	</div><!--/#container -->
     
	<?= $this->javascript ?>
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
	<script src="js/bootstrap.min.js"></script>
	
	<?= c_load::js(ARX_JS.DS.'bootstrap-modal.js') ?>
	
	<script type="text/javascript" src="js/jquery.dataTables.js"></script>

	<script type="text/javascript">
		var oTable;
		$(function(){
		   oTable = $('#labelsTable').dataTable();
		       $('#myModal').modal({
				    keyboard: false
			    })
		});
	</script>
</body>
</html>