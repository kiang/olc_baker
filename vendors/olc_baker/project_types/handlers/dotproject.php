<?php
function dotprojectHandler($configFile, $project) {
    $configContent = file_get_contents($configFile);
    $pointStart = strpos($configContent, '$dPconfig[\'dbtype\']');
    $pointEnd = strpos($configContent, '$dPconfig[\'dbpersist\']');
    $newConfigContent = substr($configContent, $pointStart, ($pointEnd - $pointStart));
    $newConfigContent = '<?php' . chr(10) . $newConfigContent;
    $tempFileName = mktime() . '.php';
    file_put_contents(TMP . $tempFileName, $newConfigContent);
    include TMP . $tempFileName;

    $result = array();
    $result['app_path'] = dirname(dirname($configFile)) . DS . $project['name'];
    $result['rewrite_base'] = $project['url_path'];
    $offset = strpos($result['rewrite_base'], '//');
    $offset = strpos($result['rewrite_base'], '/', $offset + 2);
    $result['rewrite_base'] = substr($result['rewrite_base'], $offset) . $project['name'];
    $result['db_host'] = $dPconfig['dbhost'];
    $result['db_login'] = $dPconfig['dbuser'];
    $result['db_password'] = $dPconfig['dbpass'];
    $result['db_name'] = $dPconfig['dbname'];
    unlink(TMP . $tempFileName);
    return $result;
}