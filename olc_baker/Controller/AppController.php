<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {
    var $helpers = array('Html', 'Form', 'OaTool', 'Session');
    var $components = array('RequestHandler', 'Session');
}