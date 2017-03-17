<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <p><?= $this->Html->link(__('Novo Upload'), ['action' => 'add'], ['class' => 'btn btn-primary pull-right']) ?></p>
        <div class="uploads index large-9 medium-8 columns content">
            <h3><?= __('Uploads') ?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id', __('Id')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('object_id', __('Nome do Objeto')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id', __('Usuário')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('file', __('Nome do Arquivo')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created', __('Criado')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified', __('Modificado')) ?></th>
                        <th scope="col" class="actions"><?= __('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($uploads as $upload): ?>
                    <tr>
                        <td><?= $this->Number->format($upload->id) ?></td>
                        <td><?= $upload->has('object') ? $this->Html->link($upload->object->name, ['controller' => 'Objects', 'action' => 'view', $upload->object->id]) : '' ?></td>
                        <td><?= $upload->has('user') ? $this->Html->link($upload->user->name, ['controller' => 'users', 'action' => 'view', $upload->user->id]) : '' ?></td>
                        <td><?= h($upload->file) ?></td>
                        <td><?= h($upload->created) ?></td>
                        <td><?= h($upload->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Ver'), ['action' => 'view', $upload->id]) ?>
                            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $upload->id]) ?>
                            <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $upload->id], ['confirm' => __('Are you sure you want to delete # {0}?', $upload->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('primeiro')) ?>
                    <?= $this->Paginator->prev('< ' . __('anterior')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('próximo') . ' >') ?>
                    <?= $this->Paginator->last(__('último') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} item(ns) de {{count}} total')]) ?></p>
            </div>
        </div>
    </div>
</div>    