<?php
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    define('ROOT', '//<{$rootPath}>');
}
if (!defined('APP_DIR')) {
    define('APP_DIR', '//<{$appDir}>');
}
if (!defined('CAKE_CORE_INCLUDE_PATH')) {
    define('CAKE_CORE_INCLUDE_PATH', '//<{$cakeIncludePath}>');
}
if (!defined('WEBROOT_DIR')) {
    define('WEBROOT_DIR', 'webroot');
}
if (!defined('WWW_ROOT')) {
    define('WWW_ROOT', dirname(__FILE__) . DS);
}
if (!defined('CORE_PATH')) {
    if (function_exists('ini_set') && ini_set('include_path', CAKE_CORE_INCLUDE_PATH . PATH_SEPARATOR . ROOT . DS . APP_DIR . DS . PATH_SEPARATOR . ini_get('include_path'))) {
        define('APP_PATH', null);
        define('CORE_PATH', null);
    } else {
        define('APP_PATH', ROOT . DS . APP_DIR . DS);
        define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
    }
}
if (!include(CORE_PATH . 'cake' . DS . 'bootstrap.php')) {
    trigger_error("CakePHP core could not be found.  Check the value of CAKE_CORE_INCLUDE_PATH in APP/webroot/index.php.  It should point to the directory containing your " . DS . "cake core directory and your " . DS . "vendors root directory.", E_USER_ERROR);
}
if (isset($_GET['url']) && $_GET['url'] === 'favicon.ico') {
    return;
} else {
    $Dispatcher = new Dispatcher();
    $Dispatcher->dispatch();
}
if (Configure::read() > 0) {
    echo "<!-- " . round(getMicrotime() - $TIME_START, 4) . "s -->";
}