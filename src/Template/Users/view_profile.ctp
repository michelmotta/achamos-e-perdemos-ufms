<div class="jumbotron">
	<div class="row">
		<div class="col-md-4">
			<div class="profile-photo">
				<?php echo $this->Html->image('users/'. $user->photo, ['alt' => '']); ?>
			</div>	
		</div>
		<div class="col-md-8">
			<h1><?= $user->name; ?></h1>
			<p><?= $user->description; ?></p>
			<p><strong>E-mail:</strong> <?= $user->email; ?></p>
			<p><strong>Membro desde:</strong> <?= $user->created->format('d/m/Y');; ?></p>
		</div>
	</div>
</div>	
