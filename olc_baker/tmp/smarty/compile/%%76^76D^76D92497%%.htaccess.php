<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/webroot/.htaccess */ ?>
 <IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase <?php echo $this->_tpl_vars['rewriteBase']; ?>
/
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
</IfModule>