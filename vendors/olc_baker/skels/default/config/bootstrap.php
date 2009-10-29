<?php
/*
 * 參考下面文章加入，不過在使用中文資料表時會有問題
 * http://micropipes.com/blog/2009/02/23/how-addonsmozillaorg-defends-against-xss-attacks/
 */
/*
if (array_key_exists('url',$_GET) &&
    !preg_match('/\/api\//', $_GET['url']) &&
    preg_match('/[^\w\d\/\.\-_!: ]/u',$_GET['url'])) {
    header("HTTP/1.1 400 Bad Request");
    exit;
}
*/