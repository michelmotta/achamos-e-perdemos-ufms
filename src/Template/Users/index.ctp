<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
            <?php $userRole = $this->request->session()->read('Auth.User.role'); ?>
            <?php if($userRole == 'admin') : ?>
                <p><?= $this->Html->link(__('Novo Usuário'), ['action' => 'add'], ['class' => 'btn btn-primary pull-right']) ?></p>
            <?php endif; ?>
        <div class="users index large-9 medium-8 columns content">
            <h3><?= __('Usuários') ?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id', __('Id')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name', __('Nome')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('username', __('Usuário')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('email', __('E-mail')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('phone', __('Telefone')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('photo', __('Foto de Perfil')) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('role', __('Permissão')) ?></th>
                        <th scope="col" class="actions"><?= __('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Number->format($user->id) ?></td>
                        <td><?= h($user->name) ?></td>
                        <td><?= h($user->username) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= h($user->phone) ?></td>
                        <td><?= h($user->photo) ?></td>
                        <td><?= h($user->role) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Ver'), ['action' => 'view', $user->id]) ?>
                            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $user->id]) ?>
                            <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
