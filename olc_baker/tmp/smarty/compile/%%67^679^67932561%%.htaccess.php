<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/.htaccess */ ?>
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteBase    <?php echo $this->_tpl_vars['rewriteBase']; ?>
/
    RewriteRule    ^$    webroot/    [L]
    RewriteRule    (.*) webroot/$1    [L]
 </IfModule>