<div class="jumbotron">
    <div class="row">
        <div class="col-md-12">
            <center><h1>Cadastro</h1></center>
        </div>
        </div>
        <div class="row form-register">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="register-form">
                <?= $this->Form->create($user, ['type'=>'file']) ?>
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
                            <?php echo $this->Form->control('phone', ['label' => 'Telefone', 'class' => 'form-control phone']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('photo', ['type' =>'file', 'label' => 'Foto do Perfil']); ?>
                            <?php echo $this->Form->control('photo_path', ['type' => 'hidden', 'class' => 'form-control']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <?php echo $this->Form->control('description', ['label' => 'Descrição  do Perfil', 'class' => 'form-control']); ?>
                        <?php echo $this->Form->control('role', ['type' => 'hidden', 'value' => 'user']); ?>
                        </div>
                    </div>
                    <center><?= $this->Form->button(__('<i class="fa fa-fw fa-lg fa-check-circle"></i> Cadastrar'), ['class' => 'btn btn-primary icon-btn', 'escape' => false]) ?></center>
                <?= $this->Form->end() ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </did>
</div>