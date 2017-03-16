<section class="sidebar">
  <!-- Sidebar Menu-->
  <ul class="sidebar-menu">
    <?php if($this->request->params['controller'] == 'Pages') $class = 'active'; else $class = ''; ?>
    <li class="<?= $class ?>">
      <?= $this->Html->link(__('<i class="fa fa-home"></i><span>Dashboard</span>') ,['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]) ?>
    </li>
    <?php if($this->request->params['controller'] == 'Objects') $class = 'active'; else $class = ''; ?>
    <li class="<?= $class ?>">
      <?= $this->Html->link(__('<i class="fa fa-map-marker"></i><span>Objetos</span>') ,['controller' => 'Objects', 'action' => 'index'], ['escape' => false]) ?>
    </li>
    <?php if($this->request->params['controller'] == 'Categories') $class = 'active'; else $class = ''; ?>
    <li class="<?= $class ?>">
      <?= $this->Html->link(__('<i class="fa fa-tags"></i><span>Categorias</span>') ,['controller' => 'Categories', 'action' => 'index'], ['escape' => false]) ?>
    </li>
    <?php if($this->request->params['controller'] == 'Uploads') $class = 'active'; else $class = ''; ?>
    <li class="<?= $class ?>">
      <?= $this->Html->link(__('<i class="fa fa-cloud-upload"></i><span>Uploads</span>') ,['controller' => 'Uploads', 'action' => 'index'], ['escape' => false]) ?>
    </li>
    <?php if($this->request->params['controller'] == 'Comments') $class = 'active'; else $class = ''; ?>
    <li class="<?= $class ?>">
      <?= $this->Html->link(__('<i class="fa fa-comments"></i><span>Comentários</span>') ,['controller' => 'Comments', 'action' => 'index'], ['escape' => false]) ?>
    </li>
    <?php if($this->request->params['controller'] == 'Users') $class = 'active'; else $class = ''; ?>
    <li class="<?= $class ?>">
      <?= $this->Html->link(__('<i class="fa fa-users"></i><span>Usuários</span>') ,['controller' => 'Users', 'action' => 'index'], ['escape' => false]) ?>
    </li>
    <li>
      <?= $this->Html->link(__('<i class="fa fa-share"></i><span>Voltar ao site</span>') ,['controller' => 'Pages', 'action' => 'display'], ['escape' => false]) ?>
    </li>
  </ul>
</section>