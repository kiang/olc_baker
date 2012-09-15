<?php
App::uses('Controller', 'Controller');
class AppController extends Controller
{
    public $helpers = array('Html', 'Form', 'OaTool', 'Session');
    public $components = array('RequestHandler', 'Session');
}
