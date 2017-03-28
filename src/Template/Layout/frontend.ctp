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
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

$cakeDescription = 'Achamos e Perdemos UFMS';
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

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('frontend.css') ?>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVRMJ5qy_sr21AgOrGm1Wq5cxWQJvm4nk"></script>
    <?= $this->Html->script('infobox') ?>
    <?= $this->Html->script('markerclusterer') ?>

    <?= $this->Html->script('shScripts/shCore') ?>
    <?= $this->Html->script('shScripts/shBrushJScript') ?>
    <?= $this->Html->script('shScripts/shBrushPhp') ?>

    <?= $this->Html->css('shCore.css') ?>
    <?= $this->Html->css('shThemeDefault.css') ?>
</head>
<body>
    	<!-- Navigation -->
    	<?php echo $this->element('frontend_menu'); ?>

    	<!-- Page Content -->
    	<div class="container">
			<div class="row">
				<div class="col-md-12">
               <?= $this->Flash->render() ?>
               <?= $this->fetch('content') ?>
				</div>
			</div>
         <hr>
        	<!-- Footer -->
        	<footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Achamos e Perdemos UFMS - 2017</p>
                </div>
            </div>
        	</footer>

    	</div>
    <!-- /.container -->
    <!-- Javascripts-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.js"></script>
    <?= $this->Html->script('/js/plugins/bootstrap-notify.min') ?>
    <script type="text/javascript">
       var maskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
       },
       options = {onKeyPress: function(val, e, field, options) {
               field.mask(maskBehavior.apply({}, arguments), options);
           }
       };

       $('.phone').mask(maskBehavior, options);

       SyntaxHighlighter.all()
    </script>
</body>
</html>
