<?php
function moodleHandler($configFile, $project) {
    $configContent = file_get_contents($configFile);
    $pointStart = strpos($configContent, '$CFG->dbtype');
    $pointEnd = strpos($configContent, '$CFG->directorypermissions');
    $newConfigContent = substr($configContent, $pointStart, ($pointEnd - $pointStart));
    $newConfigContent = '<?php' . chr(10) . $newConfigContent;
    $tempFileName = mktime() . '.php';
    file_put_contents(TMP . $tempFileName, $newConfigContent);
    include TMP . $tempFileName;

    $result = array();
    $result['app_path'] = dirname($configFile) . DS . $project['name'];
    $result['rewrite_base'] = $CFG->wwwroot;
    $offset = strpos($result['rewrite_base'], '//');
    $offset = strpos($result['rewrite_base'], '/', $offset + 2);
    $result['rewrite_base'] = substr($result['rewrite_base'], $offset) . '/' . $project['name'];
    $result['db_host'] = $CFG->dbhost;
    $result['db_login'] = $CFG->dbuser;
    $result['db_password'] = $CFG->dbpass;
    $result['db_name'] = $CFG->dbname;
    unlink(TMP . $tempFileName);
    return $result;
}