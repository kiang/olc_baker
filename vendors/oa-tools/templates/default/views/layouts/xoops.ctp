<?php
include ROOT . DS . 'header.php';
$xoTheme->headContent(null,
    $html->css('default') .
    $javascript->link('jquery') .
    $scripts_for_layout
);
?>
		<div class="actions">
			<ul>
				<?php if($session->read('Auth.Member.id')): ?>
				<{foreach from=$controllers key=key item=item}>
				<li><?php echo $html->link('<{$item}>', '/admin/<{$key}>'); ?></li>
				<{/foreach}>
				<li><?php echo $html->link('使用者', '/admin/members'); ?></li>
				<li><?php echo $html->link('群組', '/admin/groups'); ?></li>
				<li><?php echo $html->link('登出<{$projectLabel}>', '/members/logout'); ?></li>
				<?php else: ?>
				<li><?php echo $html->link('登入<{$projectLabel}>', '/members/login'); ?></li>
				<?php endif; ?>
			</ul>
		</div>
		<?php $session->flash(); ?>
		<div id="viewContent"><?php echo $content_for_layout; ?></div>
		<div style="text-align: right;">系統提供：<?php echo $html->link('就這間電腦工作室', 'http://olc.tw/', array('target'=>'_blank')); ?></div>
<?php
include ROOT . DS . 'footer.php';