<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <p><?= $this->Html->link(__('Novo Objeto'), ['action' => 'add'], ['class' => 'btn btn-primary pull-right']) ?></p>
        <div class="objects index large-9 medium-8 columns content">
            <h3><?= __('Objetos') ?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id', __('Id')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id', __('Nome do Usuário')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name', __('Nome do Objeto')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('type', __('Tipo do Objeto')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('date', __('Data do Ocorrido')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created', __('Criado')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified', __('Modificado')) ?></th>
                        <th scope="col" class="actions"><?= __('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objects as $object): ?>
                    <?php
                        if($object->type =='encontrado')
                            $label = '<center><span class="label label-encontrado">' . $object->type . '</span></center>';
                        else
                            $label = '<center><span class="label label-perdido">' . $object->type . '</span></center>';
                    ?>
                    <tr>
                        <td><?= $this->Number->format($object->id) ?></td>
                        <td><?= $object->has('user') ? $this->Html->link($object->user->name, ['controller' => 'Users', 'action' => 'view', $object->user->id]) : '' ?></td>
                        <td><?= h($object->name) ?></td>
                        <td><?= $label ?></td>
                        <td><?= h($object->date) ?></td>
                        <td><?= h($object->created) ?></td>
                        <td><?= h($object->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Ver'), ['action' => 'view', $object->id]) ?>
                            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $object->id]) ?>
                            <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $object->id], ['confirm' => __('Are you sure you want to delete # {0}?', $object->id)]) ?>
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