<div id="GroupsAdminAcos">
<h2><?php echo __('Permission Settings', true); ?></h2>
<p>
<?php
$urlArray = array('url' => array($groupId));
echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));
?>
</p>
<div class="paging"><?php echo $this->element('paginator', $urlArray); ?></div>
<table cellpadding="0" cellspacing="0" id="GroupsAdminAcosTable">
<tr>
	<th><?php echo $paginator->sort('Controller', 'alias', $urlArray);?></th>
</tr>
<?php
$i = 0;
foreach ($acos as $aco):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td style="text-align:left;"><?php
		echo $aco['Aco']['alias'];
		if(!empty($aco['Aco']['Aco'])) {
		    echo '<input type="checkbox" name="ctrl' . $aco['Aco']['alias'] . '" class="acoController">';
		    echo '<hr /><div id="sub' . $aco['Aco']['alias'] . '">';
		    foreach($aco['Aco']['Aco'] AS $actionAco) {
		        echo '<input type="checkbox" name="' . $aco['Aco']['alias'] . '___' . $actionAco['alias'] . '"';
		        if($actionAco['permitted'] == 1) {
		            echo ' checked="checked"';
		        }
		        echo ' class="acoPermitted">';
		        echo $actionAco['alias'] . '&nbsp;';
		    }
		    echo '</div>';
		}
		?></td>
	</tr>
<?php endforeach; ?>
</table>
<?php
echo $form->create('Group', array('url' => array('action' => 'acos', $groupId)));
echo '<ul id="permissionStack"></ul>';
echo $form->end(__('Update', true));
echo $html->scriptBlock('
$(document).ready(function() {
	$(\'input.acoPermitted\').click(function() {
		if($(\'#p\' + this.name).size() > 0) {
			$(\'#p\' + this.name).remove();
		} else {
			var itemValue = \'+\';
			if(!this.checked) {
				itemValue = \'-\';
			}
			$(\'#permissionStack\').append(\'<li id="p\' + this.name + \'">\' +
			itemValue + this.name.replace(\'___\', \'/\') +
			\'<input type="hidden" name="\' + this.name + \'" value="\' + itemValue + \'">\'+
			\'</li>\');
		}
	});
	$(\'.acoController\').click(function() {
		var controllerChecked = this.checked;
		$(\'div#\' + this.name.replace(\'ctrl\', \'sub\') + \' input.acoPermitted\').each(function() {
			if(this.checked != controllerChecked) {
				this.click();
			}
		});
	});
});
');
?>
<div class="paging"><?php echo $this->element('paginator', $urlArray); ?></div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true), array('action'=>'index'));?></li>
	</ul>
</div>
</div>