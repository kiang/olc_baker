<?php
require_once App::pluginPath('Permissible') . 'config/init.php';
/**
 * Permissible Plugin App Controller class
 *
 * Provides the basics for the Permissible Plugin
 *
 * @package permissible
 * @subpackage permissible
 */
class PermissibleAppController extends AppController {
/**
 * Array containing the names of components this plugin uses.
 *
 * @var array
 * @access public
 */
    var $components = array(
        'Security',
        'Acl',
        'Session'
    );
/**
 * Array containing the names of helpers this plugin uses.
 *
 * @var array
 * @access public
 */
    var $helpers = array(
        'Javascript',
        'Js'
    );
/**
 * Common beforeFilter for plugin. Allow all controllers/actions
 * to PAuth and set up basic authentication
 *
 * @return null
 * @access public
 */
    function beforeFilter() {
        if (isset($this->PAuth)) {
            $this->PAuth->allow('*');
        }
        $this->Security->loginOptions = array(
            'type' => 'basic',
            'realm' => Configure::read('Permissible.Realm')
        );
        $this->Security->loginUsers = Configure::read('Permissible.Users');
        $this->Security->requireLogin();
        parent::beforeFilter();
        $this->set('actions_for_layout', array());
    }
}
