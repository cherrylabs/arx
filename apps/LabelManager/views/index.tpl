<?php
require_once dirname(__FILE__).'/../core.php';
header('Content-type: text/html; charset=UTF-8'); // force header UTF-8
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" href="<?= ARX_CSS ?>/bootstrap.css" rel="stylesheet" />
	<link type="text/css" href="<?= ARX_CSS ?>/jquery-ui.css" rel="stylesheet" />
	<link type="text/css" href="<?= ARX_CSS ?>/arx.css" rel="stylesheet" />
	<style type="text/css">
	.container {
		margin: 0;
		padding: 5px;
		width: auto;
	}

		#labelsTable, .dataTable {
			font-size: 0.8em;
			margin: 0 !important;
			padding: 0;
			width: 100% !important;
		}
	</style>

	<script type="text/javascript" src="<?= ARX_JS ?>/arx.min.js"></script>
	<script type="text/javascript" src="<?= ARX_JS ?>/jquery.datatable.js"></script>
	<script type="text/javascript" src="<?= ARX_JS ?>/jquery.jeditable.js"></script>
	
	<script type="text/javascript">
	(function ($) {
		var oTable;

		$(function () {
			oTable = $('#labelsTable')
			.dataTable({
				iDisplayLength: 1000,
				bProcessing: true,
				bServerSide: true,
				sAjaxSource: "ajax?extraColumnsNb=2",
				fnDrawCallback: function () {

					$('#labelsTable tbody tr')
					.each(function (index) {
					 	var $el = $(this);
						var id = $el.children(':nth(0)').html();
						var name = $el.children(':nth(1)').html();
						var isocode = $el.children(':nth(2)').html();
						
						$el.attr('id','tr|'+ name +'|'+ isocode);
						$el.children(':nth(0)').attr({'id': 'id|'+ id, 'class': 'id'});
						$el.children(':nth(1)').attr({'id': 'name|'+ id, 'class': 'name'});
						$el.children(':nth(2)').attr({'id': 'isocode|'+ id, 'class': 'isocode'});
						$el.children(':nth(3)').attr({'id': 'value|'+ id, 'class': 'value'});
						$el.children(':nth(4)').attr({'id': 'context|'+ id, 'class': ''})
						.html('<a class="context" href="lib/a.jsonEditor.php?id='+ id +'"><i class="icon-tasks"></i></a>');
						$el.children(':nth(5)').attr({'id': 'edit|'+ id, 'class': ''})
						.html('<a class="edit" href="edit?id='+ id +'"><i class="icon-pencil" /></a>');
					});
								
					$('.context')
					.on('click', function (e) {
						e.preventDefault();

						var $this = $(this), attr = $this.data();

						arx.modal.open({
							title: attr.title || 'Label editor',
							path: this.href,
							size: attr.size || 850,
							callback: function () {
								arx.notify.add({title: 'Labels Manager', content: 'Saved!'});
								window.location.reload();
								oTable.fnDraw();
							}
						});
					});

					$('.edit')
					.on('click', function (e) {//console.log(this.href, parent.$('#arx-modal'));
						e.preventDefault();

						var attr = $(this).data();

						arx.modal.open({
							title: attr.title || 'Label editor',
							path: this.href,
							size: attr.size || 850,
							callback: function () {
								arx.notify.add({title: 'Labels Manager', content: 'Saved!'});
								window.location.reload();
								oTable.fnDraw();
							}
						});
					});
				 
					$('#labelsTable tbody td.value')
					.editable( 'inc/a.labels.load.php?insert', {			                
						type: 'textarea',
						cancel: 'Cancel',
						submit: 'OK',
						indicator: '<img src="img/indicator.gif" />',
						tooltip: 'Click to edit...',
						callback: function (sValue, y) {
							oTable.fnDraw();
						},
						height: 60
					});
					
				} // fnDrawCallback

			}); // jQuery.dataTable
		}); // jQuery.ready
	}(jQuery));
	</script>
</head>
<body>
	<div class="container">
		
		<div id="main" class="tabs">
			<table id="labelsTable" class="table table-striped table-bordered dataTable">
				
				<thead>
					<tr>
						<th width="100">Id</th>
						<th width="100">name</th>
						<th width="50" >Isocode</th>
						<th>Value</th>
						<th width="100">Context</th>
						<th width="100">Edit</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div><!--/main-->
		
		<div class="modal hide fade" id="arx-modal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Modal box</h3>
			</div>
			<div class="modal-body">
				<iframe src="" width="100%" height="100%" frameborder="0" name="iframe-modal" id="iframe-modal"></iframe>
			</div>
		</div><!--/ #arx-modal -->
		
	</div>
</body>
</html>