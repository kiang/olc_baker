<h2><{$actionLabel}></h2>
<?php
if(empty($charData)) {
    echo '目前沒有任何資料！';
} else {
    echo $flashChart->begin();
    $flashChart->setData($charData, '{n}.value', '{n}.label');
    $flashChart->axis('x', array('labels' => Set::extract($charData, '{n}.label')));
    echo $flashChart->chart('<{$parameters.settings.chart_type}>');
    echo $flashChart->render();
    echo '<table style="width:800px;">';
    foreach($charData AS $item) {
        echo '<tr><th>' . $item['label'] . '</th><td>';
        echo $item['value'] . '</td></tr>';
    }
    echo '</table>';
}
?>
<div class="actions">
    <ul>
        <li><?php echo $html->link('回到一般列表', array('action'=>'index'), array('class' => 'pageControl')); ?></li>
    </ul>
</div>