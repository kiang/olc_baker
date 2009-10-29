<?php
$currentMonth = date('Y/n', $daysRange['start']);
$previousMonth = date('Y/n', $daysRange['start'] - 1);
$nextMonth = date('Y/n', $daysRange['end'] + 1);
$lastDay = date('j', $daysRange['end']);
?>
<div id="<{$controllerName}>_control_page">
<h2><{$actionLabel}>： <?php echo $currentMonth; ?></h2>
<div class="actions">
    <ul>
    	<li><?php echo $html->link('上個月', explode('/', $previousMonth), array('class' => 'pageControl')); ?></li>
    	<li><?php echo $html->link('下個月', explode('/', $nextMonth), array('class' => 'pageControl')); ?></li>
    </ul>
</div>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th>星期一</th>
		<th>星期二</th>
		<th>星期三</th>
		<th>星期四</th>
		<th>星期五</th>
		<th>星期六</th>
		<th>星期日</th>
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
	            echo $html->link($event['<{$className}>']['<{$key}>'], array('action'=>'<{$parameters.links.view}>', $event['<{$modelName}>']['id']), array('class' => 'control'));
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
        <li><?php echo $html->link('回到一般列表', array('action'=>'index'), array('class' => 'pageControl')); ?></li>
    </ul>
</div>
<div id="<{$controllerName}>_control_panel"></div>
<?php
$scripts = '
$(document).ready(function() {
    $(\'a.pageControl\').click(function() {
        $(\'#<{$controllerName}>_control_page\').load(this.href);
        return false;
    });
    $(\'a.control\').click(function() {
        var target = $(\'#<{$controllerName}>_control_panel\');
        var targetOffset = target.offset().top;
        $(target).load(this.href, {
            success: function() {
                $(\'html,body\').animate({scrollTop: targetOffset}, 1000);
            }
        });
        return false;
    });
});';
echo $javascript->codeBlock($scripts);
?>
</div>