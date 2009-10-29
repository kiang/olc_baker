<?php
echo $form->create('Member', array('action' => 'setup'));
echo $form->input('username');
echo $form->input('password', array('type' => 'password', 'value' => ''));
echo $form->end('建立管理者');