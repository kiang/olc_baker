<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List', true), array('action'=>'index')); ?></li>
	</ul>
</div>

<?php
echo __('Build operactions:', true);
echo '<ul id="buildOperactions">';
$count = 1;
foreach($tasks AS $task) {
    echo '<li>' . $html->link($task['title'], '#', array('rel' => 'operactionBlock' . $count));
    echo '<div style="display:none;" id="operactionBlock' . $count . '"><ul>';
    foreach($task['operactions'] AS $operaction) {
        echo '<li>' . $operaction . '</li>';
    }
    echo '</ul></div></li>';
    ++$count;
}
echo '</ul>';
echo '<br /><br /><div id="operactionDetail"></div>';
echo $html->scriptBlock('
$(document).ready(function() {
	$(\'ul#buildOperactions li a\').click(function() {
		$(\'div#operactionDetail\').html(\'' . __('Operaction Detail', true) . '<br />\' + $(\'#\' + this.rel).html());
		return false;
	});
});
');