<?php
function xoopsHandler($configFile, $project) {
    $configContent = file_get_contents($configFile);
    $pointStart = strpos($configContent, '// XOOPS Physical Paths');
    $pointEnd = strpos($configContent, '// Use persistent connection');
    $newConfigContent = substr($configContent, $pointStart, ($pointEnd - $pointStart));
    $newConfigContent = '<?php' . chr(10) . $newConfigContent;
    $tempFileName = mktime() . '.php';
    file_put_contents(TMP . $tempFileName, $newConfigContent);
    include TMP . $tempFileName;

    $result = array();
    $result['app_path'] = dirname($configFile) . DS . $project['name'];
    $result['rewrite_base'] = XOOPS_URL;
    $offset = strpos($result['rewrite_base'], '//');
    $offset = strpos($result['rewrite_base'], '/', $offset + 2);
    $result['rewrite_base'] = substr($result['rewrite_base'], $offset) . '/' . $project['name'];
    $result['db_host'] = XOOPS_DB_HOST;
    $result['db_login'] = XOOPS_DB_USER;
    $result['db_password'] = XOOPS_DB_PASS;
    $result['db_name'] = XOOPS_DB_NAME;
    unlink(TMP . $tempFileName);
    return $result;
}