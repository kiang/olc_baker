<?php
/**
 * Permissible Plugin App Model class
 *
 * Provides the basics for the Permissible Plugin
 *
 * @package permissible
 * @subpackage permissible
 */
class PermissibleAppModel extends AppModel {
/**
 * Common function to wipe all data from the current tables model
 *
 * @return boolean Success
 * @access public
 */
    function truncate() {
        $db =& ConnectionManager::getDataSource($this->useDbConfig);
        $tablename = $db->fullTableName($this);
        if(!empty($tablename)) {
            return $db->query('TRUNCATE TABLE ' . $tablename . ';');
        } else {
            return false;
        }
    }

}
