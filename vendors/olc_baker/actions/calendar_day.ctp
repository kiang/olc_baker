<?php
$day = date('Y/n/j', $dayRange['start']);
$yesterday = date('Y/n/j', $dayRange['start'] - 1);
$tomorrow = date('Y/n/j', $dayRange['end'] + 1);
?>
<div id="<{$controllerName}>_control_page">
<h2><{$actionLabel}>： <?php echo $day; ?></h2>
<div class="actions">
    <ul>
    	<li><?php echo $this->Html->link(__('Yesterday', true), explode('/', $yesterday), array('class' => 'pageControl')); ?></li>
    	<li><?php echo $this->Html->link(__('Tomorrow', true), explode('/', $tomorrow), array('class' => 'pageControl')); ?></li>
    </ul>
</div>
<table cellpadding="0" cellspacing="0">
	<?php
	for($hour = 0; $hour <= 23; $hour ++) {
	    $class = null;
	    if ($hour % 2 == 0) {
	        $class = ' class="altrow"';
	    }
	    echo '<tr><th>' . $hour . '</th><td' . $class . '>&nbsp;';
	    if(!empty($events[$hour])) {
	        echo '<ul>';
	        foreach($events[$hour] AS $event) {
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
	    echo '</td></tr>';
	}
	?>
</table>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Back to the list', true), array('action'=>'index'), array('class' => 'pageControl')); ?></li>
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
echo $this->Html->scriptBlock($scripts);
?>
</div>