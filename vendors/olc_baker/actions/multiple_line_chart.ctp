<h2><{$actionLabel}></h2>
<?php
if(empty($charData)) {
    __('There\'s no data to display.');
} else {
    $colorBase = array('0', '3', '6', '9', 'A', 'C', 'F');
    echo $flashChart->begin();
    foreach($charData AS $item) {
        $color = '#' . str_repeat($colorBase[array_rand($colorBase)], 2)
        . str_repeat($colorBase[array_rand($colorBase)], 2)
        . str_repeat($colorBase[array_rand($colorBase)], 2);
        $flashChart->setData($item, 'value.{n}', false, $item['label']);
        echo $flashChart->chart('line', array(
            'tooltip' => $item['label'],
        	'text' => $item['label'],
            'colour' => $color,
        ), $item['label']);
    }
    echo $flashChart->render();
    echo '<table style="width:800px;">';
    foreach($charData AS $item) {
        echo '<tr><th>' . $item['label'] . '</th><td>';
        echo implode(',', $item['value']) . '</td></tr>';
    }
    echo '</table>';
}
?>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Back to the list', true), array('action'=>'index'), array('class' => 'pageControl')); ?></li>
    </ul>
</div>