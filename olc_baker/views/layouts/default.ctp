<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
		olc_baker
            <?php echo $title_for_layout; ?>
        </title>
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('screen', NULL, array('media' => 'screen, projection'));
            echo $this->Html->css('print', NULL, array('media' => 'print'));
            echo '<!--[if IE]>';
            echo $this->Html->css('ie', NULL, array('media' => 'screen, projection'));
            echo '<![endif]-->';
            echo $this->Html->css('jquery-ui', NULL, array('media' => 'screen, projection'));
            echo $this->Html->css('cake.generic');
            echo $this->Html->script('jquery');
            echo $this->Html->script('jquery-ui');
            echo $this->Html->script('olc');
        ?>
        </head>
        <body>
            <div id="container">
                <div id="header">
                    <h1><?php echo $this->Html->link('olc_baker', '/'); ?></h1>
                </div>
                <div id="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $content_for_layout; ?>
            </div>
            <div id="footer">
                <?php
                echo $this->Html->link(
                        $this->Html->image('cake.power.gif', array(
                            'alt' => __("CakePHP: the rapid development php framework", true), 'border' => "0")
                        ), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false), null, false
                );
                echo ' & ' . $this->Html->link('Just This Computer Studio', 'http://olc.tw/', array('target' => '_blank'));
                ?>
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>