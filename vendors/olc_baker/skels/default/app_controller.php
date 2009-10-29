<?php
class AppController extends Controller {
    var $helpers = array('Html', 'Form');
    var $components = array('Acl', 'Auth', 'RequestHandler');

    function beforeFilter() {
        if (isset($this->Auth)) {
            $this->Auth->userModel = 'Member';
            $this->Auth->userScope = array('Member.user_status' => 'Y');
            $this->Auth->loginAction = '/members/login';
            $this->Auth->loginRedirect = '/';
            $this->Auth->autoRedirect = true;
            $this->Auth->authorize = 'actions';
        }
    }

}