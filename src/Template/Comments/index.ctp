<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <p><?= $this->Html->link(__('Novo Comentário'), ['action' => 'add'], ['class' => 'btn btn-primary pull-right']) ?></p>
        <div class="comments index large-9 medium-8 columns content">
            <h3><?= __('Comentários') ?></h3>
            <div class="table-responsive">
               <table class="table">
                   <thead>
                       <tr>
                           <th scope="col"><?= $this->Paginator->sort('id', __('Id')) ?></th>
                           <th scope="col"><?= $this->Paginator->sort('object_id', __('Nome do Objeto')) ?></th>
                           <th scope="col"><?= $this->Paginator->sort('name', __('Nome do Comentário')) ?></th>
                           <th scope="col"><?= $this->Paginator->sort('email', __('E-mail do Comentário')) ?></th>
                           <th scope="col"><?= $this->Paginator->sort('status', __('Visualização')) ?></th>
                           <th scope="col"><?= $this->Paginator->sort('created', __('Criado')) ?></th>
                           <th scope="col"><?= $this->Paginator->sort('modified', __('Modificado')) ?></th>
                           <th scope="col" class="actions"><?= __('Ações') ?></th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php foreach ($comments as $comment): ?>
                       <?php
                           if($comment->status == 0)
                               $label = '<span class="label label-primary">Não Visualizado</span>';
                           else
                               $label = '<span class="label label-default">Visualizado</span>';
                       ?>
                       <tr>
                           <td><?= $this->Number->format($comment->id) ?></td>
                           <td><?= $comment->has('object') ? $this->Html->link($comment->object->name, ['controller' => 'Objects', 'action' => 'view', $comment->object->id]) : '' ?></td>
                           <td><?= h($comment->name) ?></td>
                           <td><?= h($comment->email) ?></td>
                           <td><?= $label ?></td>
                           <td><?= h($comment->created) ?></td>
                           <td><?= h($comment->modified) ?></td>
                           <td class="actions">
                               <?= $this->Html->link(__('Ver'), ['action' => 'view', $comment->id]) ?>
                               <?= $this->Html->link(__('Editar'), ['action' => 'edit', $comment->id]) ?>
                               <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]) ?>
                           </td>
                       </tr>
                       <?php endforeach; ?>
                   </tbody>
               </table>
            </div>   
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
