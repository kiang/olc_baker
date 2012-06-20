<div class="projects form">
    <?php echo $this->Form->create('Project'); ?>
    <fieldset>
        <legend><?php echo __('Create a new project'); ?></legend>
        <?php
        echo $this->Form->input('name', array('label' => __('System name')));
        echo $this->Form->input('label', array('label' => __('Display name')));
        echo $this->Form->input('rewrite_base', array('label' => __('Relative path to the root of url. For example, fill in /~kiang/demo/ when the url is http://localhost/~kiang/demo/')));
        echo $this->Form->input('app_path', array('label' => __('Absolute path to the application:')));
        echo $this->Form->input('db_host', array('label' => __('Location of database:')));
        echo $this->Form->input('db_login', array('label' => __('Username:')));
        echo $this->Form->input('db_password', array(
            'type' => 'password',
            'label' => __('Password:')
        ));
        echo $this->Form->input('db_name', array('label' => __('Database name:')));
        ?>
        <div id="optionBlock"></div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('List'), array('action' => 'index')); ?></li>
    </ul>
</div>