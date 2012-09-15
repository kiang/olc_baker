<?php
$currentMonth = date('Y/n', $daysRange['start']);
$previousMonth = date('Y/n', $daysRange['start'] - 1);
$nextMonth = date('Y/n', $daysRange['end'] + 1);
$lastDay = date('j', $daysRange['end']);
?>
<div id="<{$controllerName}>Page">
<h2><{$actionLabel}>： <?php echo $currentMonth; ?></h2>
<div class="actions">
    <ul>
    	<li><?php echo $this->Html->link(__('Previous month', true), explode('/', $previousMonth), array('class' => 'pageControl')); ?></li>
    	<li><?php echo $this->Html->link(__('Next month', true), explode('/', $nextMonth), array('class' => 'pageControl')); ?></li>
    </ul>
</div>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('Monday'); ?></th>
		<th><?php __('Tuesday'); ?></th>
		<th><?php __('Wednesday'); ?></th>
		<th><?php __('Thursday'); ?></th>
		<th><?php __('Friday'); ?></th>
		<th><?php __('Saturday'); ?></th>
		<th><?php __('Sunday'); ?></th>
	</tr>
	<tr>
	<?php
	$weekDay = date('N', $daysRange['start']);
	for($i = 1; $i < $weekDay; $i ++) {
	    echo '<td>&nbsp;</td>';
	}
	for($day = 1; $day <= $lastDay; $day ++) {
	    if($weekDay > 7) {
	        $weekDay = 1;
	        echo '</tr><tr>';
	    }
	    echo '<td><div align="right">' . $day . '</div>';
	    if(!empty($events[$day])) {
	        echo '<ul>';
	        foreach($events[$day] AS $event) {
	            echo '<li>';
<{foreach from=$blocks.title key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
	            echo $this->Html->link($event['<{$className}>']['<{$key}>'], array('action'=>'<{$parameters.links.view}>', $event['<{$modelName}>']['id']), array('class' => 'control'));
<{/foreach}>
<{/foreach}>
	            echo '</li>';
	        }
	        echo '</ul>';
	    }
	    echo '</td>';
	    ++$weekDay;
	}
	?>
	</tr>
</table>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Back to the list', true), array('action'=>'index'), array('class' => 'pageControl')); ?></li>
    </ul>
</div>
<?php
$scripts = '
$(function() {
    $(\'#<{$controllerName}>Page a.pageControl\').click(function() {
        $(\'#<{$controllerName}>Page\').parent().load(this.href);
        return false;
    });
    $(\'#<{$controllerName}>Page a.control\').click(function() {
        dialogFull(this);
        return false;
    });
});';
echo $this->Html->scriptBlock($scripts);
?>
</div>
