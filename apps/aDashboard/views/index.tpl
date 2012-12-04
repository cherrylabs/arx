<!doctype html>
<!--[if lt IE 7 ]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?= $this->title ?></title>
	
	<?= c_load::css(array(ARX_CSS.DS.'bootstrap.css', ARX_CSS.DS.'bootstrap-responsive.css')) ?>
	<link rel="stylesheet" href="css/style.css?v=1" />
	<?= $this->_head ?>
	<?= $this->_css ?>
	<?= c_hook::output('css') ?>
</head>
<body <?= $this->_body->attr ?>>
	<div class="container-fluid app-container">
		<?= $this->_body ?>
		<div id="main" class="wrapper">
		<div class="row-fluid">
			<div class="accordion span6" id="Users Profile">
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" href="#collapseFour" data-parent="#example2" data-toggle="collapse">Users profile</a> <a class="config" href="#config" title="Configuration"><i class="icon-wrench"></i></a>
					</div>
					<div class="accordion-body collapse in" id="collapseFour">
						<div class="accordion-inner accordion-full">
							
							<?php
								
								$aUsers = $this->users->find_array();
								
								foreach($aUsers as $key=>$v)
								{
									$data[$v['id']]['id'] = $v['id'];
									$data[$v['id']]['email'] = $v['email'];
									$data[$v['id']]['updated date'] = $v['updated'];
									$data[$v['id']]['project'] = '<a href="user/project/'.$v['id'].'" class="arx-modal" title=""><i class="icon-film"></i></a>';
									$data[$v['id']]['Project Status'] = '<a href="user/project/'.$v['id'].'"><i class="icon-film"></i></a>';
								}
								
								$this->data = $data;
								
								echo $this->fetch(ARX_HELPERS.DS.'table'.TPL);
								
								
								
							?>
						<h2>Nouvel utilisateur</h2>
						<?php
							$form = new c_form(null, array('method' => 'POST'));
							
							$form->input('email');
							
							$form->input('password');
							
							$form->submit('new_user', 'Créer');
							
							echo $form->output();
						?>
						</div>
					</div>
				</div>
			</div><!--/.accordion -->
			<div class="accordion span6" id="example2">
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" href="#collapseFour" data-parent="#example2" data-toggle="collapse">Last projects</a> <a class="config" href="#config" title="Configuration"><i class="icon-wrench"></i></a>
					</div>
					<div class="accordion-body collapse in" id="collapseFour">
						<div class="accordion-inner accordion-full">
							
							<?php
								
								$aProjects = $this->projects->find_array();
								
								$data = array();
								
								foreach($aProjects as $key=>$v)
								{
									$oJson = json_decode($v['value']);
									
									$data[$v['id']]['id'] = $v['id'];
									$data[$v['id']]['project title'] = $oJson->title;
									$data[$v['id']]['userid'] = $v['userid'];
									$data[$v['id']]['updated date'] = $v['created'];
									$data[$v['id']]['facturation'] = $v['facturation'];
									$data[$v['id']]['current round'] = $v['currentRound'];
									$data[$v['id']]['project'] = '<a href="user/project/'.$v['id'].'"><i class="icon-film"></i></a>';
									$data[$v['id']]['Project Status'] = '<a href="user/project/'.$v['id'].'"><i class="icon-film"></i></a>';
								}
								
								$this->data = $data;
								
								echo $this->fetch(ARX_HELPERS.DS.'table'.TPL);
								
								
							?>
						
						</div>
					</div>
				</div>
				</div>
			</div><!--/.accordion -->
		</div><!--/#main -->
	</div><!--/#container -->
	<?= $this->javascript ?>
	<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?= ARX_JS ?>/jquery.min.js"><\/script>')</script>
	<script src="<?= ARX_JS ?>/bootstrap.js"></script>
	<script src="<?= ARX_JS ?>/arx.min.js"></script>
	<script type="text/javascript">
	$(function() {
		
		$('.arx-modal').on('click', 
			function(e){
			e.preventDefault();

			var attr = $(this).data();
			
			arx.modal.open({
							title: attr.title,
							path: this.href,
							size: attr.size || 850,
							callback: function () {
								window.location.reload();
							}
			});
		});
	});
	</script>
</body>
</html>