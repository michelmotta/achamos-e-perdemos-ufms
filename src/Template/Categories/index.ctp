<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <p><?= $this->Html->link(__('Nova Categoria'), ['action' => 'add'], ['class' => 'btn btn-primary pull-right']) ?></p>
        <div class="categories index large-9 medium-8 columns content">
            <h3><?= __('Categorias') ?></h3>
            <div class="table-responsive">
               <table class="table">
                   <thead>
                       <tr>
                           <th scope="col"><?= $this->Paginator->sort('id', __('Id')) ?></th>
                           <th scope="col"><?= $this->Paginator->sort('name', __('Nome da Categoria')) ?></th>
                           <th scope="col"><?= $this->Paginator->sort('created', __('Criado')) ?></th>
                           <th scope="col"><?= $this->Paginator->sort('modified', __('Modificado')) ?></th>
                           <th scope="col" class="actions"><?= __('Ações') ?></th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php foreach ($categories as $category): ?>
                       <tr>
                           <td><?= $this->Number->format($category->id) ?></td>
                           <td><?= h($category->name) ?></td>
                           <td><?= h($category->created) ?></td>
                           <td><?= h($category->modified) ?></td>
                           <td class="actions">
                               <?= $this->Html->link(__('Ver'), ['action' => 'view', $category->id]) ?>
                               <?= $this->Html->link(__('Editar'), ['action' => 'edit', $category->id]) ?>
                               <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?>
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
