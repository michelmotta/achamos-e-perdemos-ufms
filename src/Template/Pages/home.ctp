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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('frontend.css') ?>
    <?= $this->Html->script('jquery-2.1.4.min') ?>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?php echo $this->element('frontend_menu'); ?>
    <div class="container">
        <header class="jumbotron hero-spacer">
            <h1><i class="fa fa-map-marker"></i> Achamos e Perdemos UFMS!</h1>
            <p>Encontre aqui o que você perdeu ou compartilhe algo que você encontrou</p>
            <p><?= $this->Html->link(__('Todos os objetos'), ['controller' => 'Objects', 'action' => 'listAllUnsolvedObjects'], ['class' => 'btn btn-primary btn-large']) ?></p>
        </header>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <h3>Últimos Objetos</h3>
            </div>
        </div>
        <div class="row text-center">
            <?php
                $post_counter = 0;
                $per_row = 3;

                foreach ($objects as $object) {
                    if ( $post_counter % $per_row == 0 && $post_counter !== 0 )
                        echo '</div><div class="row text-center">';

                if($object->type == 'encontrado'){
                    $class = "encontrado";
                    $border = "#FFD700;";
                }else{
                    $class = "perdido";
                    $border = "#FF4500;";
                }
            ?>
            <div class="col-md-4 hero-feature">
                <div class="thumbnail" style="border: 3px solid <?php echo $border; ?>">
                    <div class="thumbnail-type <?php echo $class; ?>">
                            <p><?= $object->type; ?></p>
                    </div>
                    <?php
                    if (!empty($object->uploads)):
                        foreach ($object->uploads as $uploads):
                            echo $this->Html->image('uploads/'. $uploads->file, ['alt' => '']);
                            break;
                        endforeach;
                    endif;
                    ?>
                    <div class="caption">
                        <h3><?= $object->name; ?></h3>
                        <p><?= $this->TextLimit->limitText($object->description, 150); ?></p>
                        <p><?= $this->Html->link(__('Ver Detalhes'), ['controller' => 'Objects', 'action' => 'singleItem', $object->id], ['class' => 'btn btn-primary']) ?></p>
                        <p id="publicado"><?= $this->Html->link(__('Publicado por: ' . $object->user->name), ['controller' => 'Users', 'action' => 'viewProfile', $object->user->id]) ?></p>
                    </div>
                </div>
            </div>
            <?php $post_counter++; } ?>
        </div>
        <hr>
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Achamos e Perdemos UFMS - 2017</p>
                </div>
            </div>
        </footer>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.js"></script>
    <?= $this->Html->script('essential-plugins') ?>
    <?= $this->Html->script('bootstrap.min') ?>
    <?= $this->Html->script('/js/plugins/pace.min') ?>
    <?= $this->Html->script('/js/plugins/bootstrap-datepicker.min') ?>
    <?= $this->Html->script('/js/plugins/bootstrap-datepicker.pt-BR') ?>
    <?= $this->Html->script('/js/plugins/select2.min') ?>
    <?= $this->Html->script('/js/plugins/bootstrap-notify.min') ?>
    <?= $this->Html->script('main') ?>
</body>
</html>
