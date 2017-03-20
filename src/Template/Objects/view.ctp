<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
<div class="objects view large-9 medium-8 columns content">
    <h3><?= h($object->name) ?></h3>
    <table class="table table-hover">
        <tr>
            <th scope="row"><?= __('Nome do Usuário') ?></th>
            <td><?= $object->has('user') ? $this->Html->link($object->user->name, ['controller' => 'Users', 'action' => 'view', $object->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome do Objeto') ?></th>
            <td><?= h($object->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo do Objeto') ?></th>
            <td><?= h($object->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Endereço do Local') ?></th>
            <td><?= h($object->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude do Local') ?></th>
            <td><?= h($object->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude do Local') ?></th>
            <td><?= h($object->longitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($object->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data') ?></th>
            <td><?= h($object->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Criado') ?></th>
            <td><?= h($object->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modificado') ?></th>
            <td><?= h($object->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <div class="col-md-12">
            <h4><?= __('Descrição') ?></h4>
            <?= $this->Text->autoParagraph(h($object->description)); ?>
        </div>
    </div>
</div>
