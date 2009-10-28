<div class="actions">
	<ul>
		<li><?php echo $html->link('回到專案列表', array('action'=>'index')); ?></li>
	</ul>
</div>

操作過程：<?php
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
echo $javascript->codeBlock('
$(document).ready(function() {
	$(\'ul#buildOperactions li a\').click(function() {
		$(\'div#operactionDetail\').html(\'操作細節<br />\' + $(\'#\' + this.rel).html());
		return false;
	});
});
');