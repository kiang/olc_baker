<?php
/**
 * Permissible Plugin Permissible Controller class
 *
 * Provides the home page for the permissible plugin
 *
 * @package permissible
 * @subpackage permissible.controllers
 */
class PermissibleController extends PermissibleAppController {
/**
 * Name of the controller
 *
 * @var string
 * @access public
 */
    var $name = 'Permissible';
/**
 * Name of model used by the controller
 *
 * @var array
 * @access public
 */
    var $uses = array();
/**
 * Index function - blank, just contains links to other pages
 *
 * @return null
 * @access public
 */
    function index() {
    }
/**
 * Reset function - calls reset on both the ARO and ACO models
 *
 * @return null
 * @access public
 */
    function reset() {
        $this->loadModel('Permissible.PermissibleAro');
        $this->PermissibleAro->reset();
        $this->loadModel('Permissible.PermissibleAco');
        if ($this->PermissibleAco->reset()) {
            $this->Acl->deny('everyone', 'app');
            $this->Acl->allow('1', 'app');
        }
        $this->Session->setFlash('The ACO and ARO lists have been updated');
        $this->redirect(array('plugin' => 'permissible', 'controller' => 'permissible', 'action' => 'index'));
    }
}
