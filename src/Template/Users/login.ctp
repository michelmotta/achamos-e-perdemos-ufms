<section class="material-half-bg">
  <div class="cover"></div>
</section>
<section class="login-content">
  <div class="message">
    <?= $this->Flash->render() ?>
  </div>
  <div class="login-box">
    <?= $this->Form->create('', ['class' => 'login-form']) ?>
      <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Área Restrita</h3>
      <div class="form-group">
        <?= $this->Form->input('username', ['label' => 'Usuário' ,'class' => 'form-control', 'placeholder' => 'Digite seu usuário']) ?>
      </div>
      <div class="form-group">
        <?= $this->Form->input('password', ['label' => 'Senha', 'class' => 'form-control', 'placeholder' => 'Digite sua senha']) ?>
      </div>
      <div class="form-group">
        <div class="utility">
          <div class="animated-checkbox">
            <label class="semibold-text">
              <input type="checkbox"><span class="label-text">Lembrar-me</span>
            </label>
          </div>
          <p class="semibold-text mb-0"><a id="toFlip" href="#">Esqueceu a senha?</a></p>
        </div>
      </div>
      <div class="form-group btn-container">
      <?= $this->Form->button(__('Login <i class="fa fa-sign-in fa-lg"></i>'), ['class' => 'btn btn-primary btn-block', 'escape' => false]); ?>
      </div>
    <?= $this->Form->end() ?>
    <form action="index.html" class="forget-form">
      <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Esqueceu a senha?</h3>
      <div class="form-group">
        <label class="control-label">E-MAIL</label>
        <input type="text" placeholder="Digite seu email cadastrado" class="form-control">
      </div>
      <div class="form-group btn-container">
        <button class="btn btn-primary btn-block">RESETAR <i class="fa fa-unlock fa-lg"></i></button>
      </div>
      <div class="form-group mt-20">
        <p class="semibold-text mb-0"><a id="noFlip" href="#"><i class="fa fa-angle-left fa-fw"></i> Voltar ao Login</a></p>
      </div>
    </form>
  </div>
</section>
<style>
.navbar ul li a{
   color: #fff;
}
.navbar ul li a:hover{
   color: #4B0082;
}
.navbar{
   background: #4B0082;
}
</style>
