<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
    <?= $this->Html->script('jquery-2.1.4.min') ?>

    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('backend.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
   <!-- Navigation -->
   <?php echo $this->element('frontend_menu'); ?>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    <!-- Javascripts-->
    <?= $this->Html->script('essential-plugins') ?>
    <?= $this->Html->script('bootstrap.min') ?>
    <?= $this->Html->script('/js/plugins/pace.min') ?>
    <?= $this->Html->script('/js/plugins/bootstrap-datepicker.min') ?>
    <?= $this->Html->script('/js/plugins/bootstrap-datepicker.pt-BR') ?>
    <?= $this->Html->script('/js/plugins/bootstrap-notify.min') ?>
    <?= $this->Html->script('main') ?>
  </body>
</html>
