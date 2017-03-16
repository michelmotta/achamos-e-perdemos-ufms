<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <div class="categories form large-9 medium-8 columns content">
            <?= $this->Form->create($category) ?>
            <fieldset>
                <legend><?= __('Editar Categoria') ?></legend>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $this->Form->control('name', ['label' => 'Nome da Categoria', 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $this->Form->control('description', ['label' => 'Descrição', 'class' => 'form-control']); ?>
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