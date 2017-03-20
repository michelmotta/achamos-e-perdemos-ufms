<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<?php echo $this->Form->create();?>
		<div id="custom-search-input">
			<div class="input-group col-md-12">
				<input type="text" class="form-control input-lg" placeholder="Realizar uma pesquisa" name="q"/>
				<span class="input-group-btn">
					<button class="btn btn-info btn-lg" type="submit">
							<i class="glyphicon glyphicon-search"></i>
					</button>
				</span>
			</div>
		</div>
		<?php echo $this->Form->end();?>
	</div>
	<div class="col-md-2"></div>
</div>
<!-- Page Features -->
<div class="row text-center">
	<?php
		$post_counter = 0;
		$per_row = 3;

		foreach ($objects as $object) {
			if ( $post_counter % $per_row == 0 && $post_counter !== 0 )
				echo '</div><div class="row text-center">';
	?>
	<div class="col-md-4 hero-feature">
		<div class="thumbnail" style="border: 3px solid #006400">
			<div class="thumbnail-type" style="background: #006400">
					<p><?= $object->type; ?></p>
			</div>
			<?php
			if (!empty($object->uploads)):
				foreach ($object->uploads as $uploads):
					echo $this->Html->image('uploads/'. $uploads->file, ['alt' => '']);
					break;
				endforeach;
			endif;
			?>
			<div class="caption">
				<h3><?= $object->name; ?></h3>
				<p><?= $object->description; ?></p>
				<p><?= $this->Html->link(__('Ver Detalhes'), ['controller' => 'Objects', 'action' => 'singleItem', $object->id], ['class' => 'btn btn-primary']) ?></p>
				<p id="publicado"><?= $this->Html->link(__('Publicado por: ' . $object->user->name), ['controller' => 'Users', 'action' => 'viewProfile', $object->user->id]) ?></p>
			</div>
		</div>
	</div>
	<?php $post_counter++; } ?>
</div>
<!-- /.row -->
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
