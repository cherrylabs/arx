<?php
/**
	 * LABELS ADMIN 
	 * @author Daniel Sum
	 * @version 0.1
	 * @package arx
	 * @comments :
*/

require_once(dirname(__FILE__).'/../arx/core.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title></title>
		<link type="text/css" href="css/arx/jquery.ui.css" rel="stylesheet" />	
		<link type="text/css" href="css/jquery.dataTables.css" rel="stylesheet" />
		<link type="text/css" href="css/jquery.fancybox.css" rel="stylesheet" />
		<style>
			textarea
			{
				height:100%;
			}
			td{
				text-align: center;
			}
			body{
				background: #E5E5E5;
			}
			#wrapper{
				width: 900px;
				margin:10px auto;
				background: #FFF;
				border-radius: 5px;
				padding: 20px 10px;
			}
			.dataTables_wrapper{
			}
		</style>
	</head>
	<body>
	<div id="wrapper">
		<h2>Labels panel :</h2>
			<a href="#" onclick="addLabel()"><?php echo lg('addALabel'); ?></a>
			<a href="#" onclick="addLabel()"><?php echo lg('addLabels'); ?></a>
			<form method="post" action="../arx/labels.php?insert">
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
				<td><input type="text" name="name" /></td>
				<td><textarea name="value"></textarea></td>
				<td>
					<select name="isocode">
						<option value="fr">french</option>
						<option value="nl">dutch</option>
					</select>
				</td>
				<td><textarea></textarea></td>
				</tr>
				<input type="submit" name="send" value="envoyer" />
			</table>
			</form>
			
			<form method="post" action="../arx/labels.php?multiinsert">
					<textarea name="multivalue">name;isocode;value;context</textarea>
					<input type="separator" value=";" />
				<input type="submit" name="send" value="envoyer" />
			</form>
			<table cellpadding="0" cellspacing="0" border="0" class="dataTable display">
				<thead>
					<tr>
						<th>name</th>
						<th>Value</th>
						<th>Isocode</th>
						<th>Context</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
	</div>
		<script type="text/javascript" src="<?= ARX_JS ?>jquery.js" /></script>
		<script type="text/javascript" src="<?= ARX_JS ?>/jquery.dataTables.js" /></script>
		<script type="text/javascript" src="<?= ARX_JS ?>/jquery.easing.js" /></script>
		<script type="text/javascript" src="<?= ARX_JS ?>/jquery.jeditable.js" /></script>
		<script type="text/javascript" src="<?= ARX_JS ?>/jquery.mousewheel.js" /></script>
		<script type="text/javascript" src="<?= ARX_JS ?>/jquery.ui.js" /></script>
		<script type="text/javascript">
			var oTable;
			$(function(){
			   oTable = $('.dataTable').dataTable( {
			        "bProcessing": true,
			        "bServerSide": true,
			        "sAjaxSource": "../arx/dataProcessing.php",
			        "fnDrawCallback": function () {
			        	 $('.dataTable tr').each(function(index) {
			        	 	var name = $(this).children(':nth(0)').html();
			        	 	var isocode = $(this).children(':nth(2)').html();
			        	 	$(this).attr('id','tr_'+name+'_'+isocode);
			        	 	$(this).children(':nth(0)').attr('id','name_'+name+'_'+isocode).attr('class','name');
			        	 	$(this).children(':nth(1)').attr('id','value_'+name+'_'+isocode).attr('class','value');
			        	 	$(this).children(':nth(2)').attr('id','isocode_'+name+'_'+isocode).attr('class','isocode');
			        	 	$(this).children(':nth(3)').attr('id','context_'+name+'_'+isocode).attr('class','context');
						 });
			          $('.dataTable tbody td.value, .dataTable tbody td.context').editable( '../arx/labels.php?insert',
			          	{			                
					         type      : 'textarea',
					         cancel    : 'Cancel',
					         submit    : 'OK',
					         indicator : '<img src="img/indicator.gif">',
					         tooltip   : 'Click to edit...',
			                "callback": function(sValue,y) {
			                   oTable.fnDraw();
			                },
			                "height": "60px"
			            });
			          
			          $('.dataTable tbody td.name').editable( '../arx/labels.php?insert',
			          	{
					         indicator : '<img src="img/indicator.gif">',
			                "callback": function(sValue,y) {
			                   oTable.fnDraw();
			                },
			                "height": "14px"
			            });
			        
			        $('.dataTable tbody td.isocode').editable( '../arx/labels.php?insert',
			          	{
			          		data : '<?php echo LANGUAGES; ?>',
	      					type : 'select',
	      					submit : 'Ok',
					         indicator : '<img src="img/indicator.gif">',
			                "callback": function(sValue,y) {
			                   oTable.fnDraw();
			                },
			                "height": "14px"
			            });
			          
			          
			        }
			       
			    });
			});
		</script>
	</body>
</html>