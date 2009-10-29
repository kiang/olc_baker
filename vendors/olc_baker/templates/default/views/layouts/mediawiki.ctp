<?php
global $wgUser;
$skin = $wgUser->getSkin();
$body = new OutputPage();
$body->mPagetitle = '';
$body->mHTMLtitle = '<{$projectLabel}>' . $title_for_layout;
$body->mIsarticle = false;
$body->mNoGallery = true;
$body->addHeadItem('cakeHead',
    $html->meta('icon') .
    $html->css('default') .
    $html->script('jquery') .
    $scripts_for_layout
);
$body->mBodytext = '';
$body->mBodytext .= '<div id="container">';
$body->mBodytext .= '<div class="actions"><ul>';
if($session->read('Auth.Member.id')) {
<{foreach from=$controllers key=key item=item}>
    $body->mBodytext .= '<li>' . $html->link('<{$item}>', '/admin/<{$key}>') . '</li>';
<{/foreach}>
    $body->mBodytext .= '<li>' . $html->link('使用者', '/admin/members') . '</li>';
    $body->mBodytext .= '<li>' . $html->link('群組', '/admin/groups') . '</li>';
    $body->mBodytext .= '<li>' . $html->link('登出', '/members/logout') . '</li>';
} else {
    $body->mBodytext .= '<li>' . $html->link('登入', '/members/login') . '</li>';
}
$body->mBodytext .= '</ul></div>' . $session->flash() . $content_for_layout;
$body->mBodytext .= '</div>';
$body->mBodytext .= '<div style="text-align: right;">系統提供：' . $html->link('就這間電腦工作室', 'http://olc.tw/', array('target'=>'_blank')) . '</div>';
$body->mBodytext .= $cakeDebug;
echo $skin->outputPage($body);