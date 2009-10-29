<?php
function mediawikiHandler($configFile, $project) {
    $configContent = file_get_contents($configFile);
    $pointStart = strpos($configContent, '$wgSitename');
    $pointEnd = strpos($configContent, '$wgDBprefix');
    $newConfigContent = substr($configContent, $pointStart, ($pointEnd - $pointStart));
    $newConfigContent = '<?php' . chr(10) . $newConfigContent;
    $tempFileName = mktime() . '.php';
    file_put_contents(TMP . $tempFileName, $newConfigContent);
    include TMP . $tempFileName;
    $result = array();
    $result['app_path'] = dirname($configFile) . DS . $project['name'];
    $result['rewrite_base'] = $wgScriptPath . '/' . $project['name'];
    $result['db_host'] = $wgDBserver;
    $result['db_login'] = $wgDBuser;
    $result['db_password'] = $wgDBpassword;
    $result['db_name'] = $wgDBname;
    unlink(TMP . $tempFileName);
    return $result;
}