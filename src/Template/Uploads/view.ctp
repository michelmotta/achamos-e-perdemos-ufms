<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <div class="uploads view large-9 medium-8 columns content">
            <h3><?= h($upload->id) ?></h3>
            <table class="table table-hover">
                <tr>
                    <th scope="row"><?= __('Objeto') ?></th>
                    <td><?= $upload->has('object') ? $this->Html->link($upload->object->name, ['controller' => 'Objects', 'action' => 'view', $upload->object->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Usuário') ?></th>
                    <td><?= $upload->has('user') ? $this->Html->link($upload->user->name, ['controller' => 'Users', 'action' => 'view', $upload->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Arquivo') ?></th>
                    <td><?= h($upload->file) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Caminho') ?></th>
                    <td><?= h($upload->file_path) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($upload->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Criado') ?></th>
                    <td><?= h($upload->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modificado') ?></th>
                    <td><?= h($upload->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>        