<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <div class="users view large-9 medium-8 columns content">
            <h3><?= h($user->name) ?></h3>
            <table class="table table-hover">
                <tr>
                    <th scope="row"><?= __('Nome') ?></th>
                    <td><?= h($user->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Usuário') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('E-mail') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Telefone') ?></th>
                    <td><?= h($user->phone) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Foto') ?></th>
                    <td><?= h($user->photo) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Pasta') ?></th>
                    <td><?= h($user->photo_path) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Permissão') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Criado') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modificado') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
            <div class="row">
                <div class="col-md-12">
                <h4><?= __('Descrição') ?></h4>
                <?= $this->Text->autoParagraph(h($user->description)); ?>
            </div>
        </div>
    </div>    
</div>