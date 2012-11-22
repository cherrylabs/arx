<?php global $hooked_css, $hooked_js ; ?>
<form method="post" action="" <?= C_HTML::attributes($this->_formAttributes) ?>>
<table id="<?= $this->id ?>" class="arx_datatable table table-striped table-bordered <?= $this->class ?>" border="1">
	<thead>
		<tr>
			<?php 
				echo '<th><input type="checkbox" /></th>';
				foreach(reset($this->data) as $key=>$name){
					echo '<th>'.$key.'</th>';
				}
				echo '<th>delete</th>';
				echo '<th>edit</th>';
			?>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($this->data as $key=>$row)
			{
				
				echo '<tr>';
					echo '<td><input type="checkbox" /></td>';
					foreach($row as $key=>$col)
					{
						echo '<td>'.$col.'</td>';
					}
					echo '<td class="a-delete" id="row-'.$row['id'].'"><i class="arx-delete icon-trash"></i></td>';
					echo '<td class="a-update" id="row-'.$row['id'].'"><i class="arx-update icon-pencil"></i></td>';
				echo '</tr>';
			}
		?>
	</tbody>
</table>
<div>
	<button>Delete Selection</button>
	<button>Add</button>
</div>
</form>