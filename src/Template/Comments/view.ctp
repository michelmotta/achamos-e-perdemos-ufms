<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <div class="comments view large-9 medium-8 columns content">
            <h3><?= h($comment->name) ?></h3>
            <table class="table table-hover">
                <tr>
                    <th scope="row"><?= __('Nome do Objeto') ?></th>
                    <td><?= $comment->has('object') ? $this->Html->link($comment->object->name, ['controller' => 'Objects', 'action' => 'view', $comment->object->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Nome do Comentário') ?></th>
                    <td><?= h($comment->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('E-mail do Comentário') ?></th>
                    <td><?= h($comment->email) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Visualização') ?></th>
                    <td><?= h($comment->status) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($comment->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Criado') ?></th>
                    <td><?= h($comment->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modificado') ?></th>
                    <td><?= h($comment->modified) ?></td>
                </tr>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <h4><?= __('Comentário') ?></h4>
                    <?= $this->Text->autoParagraph(h($comment->comment)); ?>
                </div>
            </div>
        </div>
    </div>
</div>