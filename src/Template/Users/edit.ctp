<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <div class="users form large-9 medium-8 columns content">
            <?= $this->Form->create($user, ['type'=>'file']) ?>
            <fieldset>
                <legend><?= __('Edit User') ?></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $this->Form->control('name', ['label' => 'Nome', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('username', ['label' => 'Usuário', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $this->Form->control('email', ['label' => 'E-mail', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('password', ['label' => 'Senha', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $this->Form->control('phone', ['label' => 'Telefone', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('photo', ['type' =>'file', 'label' => 'Foto de Perfil']); ?>
                            <?php echo $this->Form->control('photo_path', ['type' => 'hidden', 'class' => 'form-control']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $this->Form->control('role', ['options' => ['user' => 'Usuário', 'admin' => 'Admin'], 'label' => 'Permissão', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $this->Form->control('description', ['label' => 'Descrição  do Perfil', 'class' => 'form-control']); ?>
                        </div>
                    </div>  
            </fieldset>
            <div class="card-footer">
                <?= $this->Form->button(__('<i class="fa fa-fw fa-lg fa-check-circle"></i> Salvar'), ['class' => 'btn btn-primary icon-btn', 'escape' => false]) ?>
                <?= $this->Form->end() ?>
                <?= $this->Html->link(__('<i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar') ,['action' => 'index'], ['class' => 'btn btn-default icon-btn', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</div>