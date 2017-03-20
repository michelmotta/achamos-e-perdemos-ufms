<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <div class="comments form large-9 medium-8 columns content">
            <?= $this->Form->create($comment) ?>
            <fieldset>
                <legend><?= __('Editar Comentário') ?></legend>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $this->Form->control('name', ['label' => 'Nome do Comentário', 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('email', ['label' => 'E-mail do Comentário', 'class' => 'form-control']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $this->Form->control('status', ['options' => ['0' => 'Não Visualizado', '1' => 'Visualizado'], 'label' => 'Visualização', 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('object_id', ['options' => $objects, 'label' => 'Nome do Objeto', 'class' => 'form-control']); ?>
                    </div>
                </div><div class="row">
                    <div class="col-md-12">
                        <?php echo $this->Form->control('comment', ['label' => 'Comentário', 'class' => 'form-control']); ?>
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