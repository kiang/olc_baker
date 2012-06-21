<h2>Sweet, Your application got Baked by CakePHP!</h2>
<h3><?php __('Editing this Page') ?></h3>
<p>
<?php
	printf(__('To change the content of this page, edit: %s
		To change its layout, edit: %s
		You can also add some CSS styles for your pages at: %s', true),
		APP . 'views' . DS . 'pages' . DS . 'home.ctp.<br />',  APP . 'views' . DS . 'layouts' . DS . 'default.ctp.<br />', APP . 'webroot' . DS . 'css');
?>
</p>
