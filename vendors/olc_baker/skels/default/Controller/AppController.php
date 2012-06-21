<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {

    var $helpers = array('Html', 'Form', 'Js', 'Session');
    var $components = array('Acl', 'Auth', 'RequestHandler', 'Session');

    function beforeFilter() {
        if (isset($this->Auth)) {
            $this->Auth->authenticate = array(
                'Form' => array(
                    'userModel' => 'Member',
                    'scope' => array('Member.user_status' => 'Y'),
                )
            );
            $this->Auth->loginAction = '/members/login';
            $this->Auth->loginRedirect = '/';
            $this->Auth->authorize = array(
                'Actions' => array(
                    'userModel' => 'Member',
                )
            );
        }
    }

}