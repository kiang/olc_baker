<?php
define('BLOCK_L_MIN_WIDTH', 160);
define('BLOCK_L_MAX_WIDTH', 210);
define('BLOCK_R_MIN_WIDTH', 160);
define('BLOCK_R_MAX_WIDTH', 210);

$PAGE       = page_create_object(PAGE_COURSE_VIEW, SITEID);
$pageblocks = blocks_setup($PAGE);
$editing    = $PAGE->user_is_editing();
$preferred_width_left  = bounded_number(BLOCK_L_MIN_WIDTH, blocks_preferred_width($pageblocks[BLOCK_POS_LEFT]),
                                        BLOCK_L_MAX_WIDTH);
$preferred_width_right = bounded_number(BLOCK_R_MIN_WIDTH, blocks_preferred_width($pageblocks[BLOCK_POS_RIGHT]),
                                        BLOCK_R_MAX_WIDTH);
$headContent = $html->meta('icon') .
    $html->css('default') .
    $html->script('jquery') .
    $scripts_for_layout;
print_header(
'<{$projectLabel}>' . $title_for_layout,
'<{$projectLabel}>' . $title_for_layout,
'home', '',$headContent,
true, '', user_login_string($SITE).$langmenu);
?>
<table id="layout-table">
  <tr>
  <?php
    if (blocks_have_content($pageblocks, BLOCK_POS_LEFT) || $editing) {
        echo '<td style="width: '.$preferred_width_left.'px;" id="left-column">';
        blocks_print_group($PAGE, $pageblocks, BLOCK_POS_LEFT);
        echo '</td>';
    }

    echo '<td id="middle-column">';
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
<?php
    echo '</td>';


    if (blocks_have_content($pageblocks, BLOCK_POS_RIGHT) || $editing || isadmin()) {
        echo '<td style="width: '.$preferred_width_right.'px;" id="right-column">';
        if (isadmin()) {
            echo '<div align="center">'.update_course_icon($SITE->id).'</div>';
            echo '<br />';
        }
        blocks_print_group($PAGE, $pageblocks, BLOCK_POS_RIGHT);
        echo '</td>';
    }

?>
  </tr>
</table>
<div style="text-align: right;">系統提供：<?php echo $html->link('就這間電腦工作室', 'http://olc.tw/', array('target'=>'_blank')); ?></div>
<?php
print_footer('home');