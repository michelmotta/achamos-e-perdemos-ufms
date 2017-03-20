<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <div class="uploads form large-9 medium-8 columns content">
            <?= $this->Form->create($upload, ['type'=>'file']) ?>
            <fieldset>
                <legend><?= __('Adicionar Upload') ?></legend>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $this->Form->control('object_id', ['options' => $objects, 'label' => 'Objeto', 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('user_id', ['options' => $users, 'label' => 'Usuário', 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('file', ['type' =>'file', 'label' => 'Arquivo']); ?>
                        <?php echo $this->Form->control('file_path', ['type' => 'hidden']); ?>
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