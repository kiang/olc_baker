<?php
echo $form->create('Member', array('action' => 'login'));
echo $form->input('username');
echo $form->input('password');
echo $form->end(__('Login', true));