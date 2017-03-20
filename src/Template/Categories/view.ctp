<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <div class="categories view large-9 medium-8 columns content">
            <h3><?= h($category->name) ?></h3>
            <table class="table table-hover">
                <tr>
                    <th scope="row"><?= __('Nome da categoria') ?></th>
                    <td><?= h($category->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($category->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Criado') ?></th>
                    <td><?= h($category->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modificado') ?></th>
                    <td><?= h($category->modified) ?></td>
                </tr>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <h4><?= __('Descrição') ?></h4>
                    <?= $this->Text->autoParagraph(h($category->description)); ?>
                </div>
            </div>
        </div>
    </div>    
</div>