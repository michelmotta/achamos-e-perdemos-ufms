<div class="jumbotron">
	<div class="row">
		<div class="col-md-6">

			<?php if (!empty($object->uploads)): ?>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php
						$count = 1;
						foreach ($object->uploads as $uploads):
							if($count == 1)
								$active = 'active';
							else
								$active = '';
							echo '<div class="item '. $active . '">';
								echo $this->Html->image('uploads/'. $uploads->file, ['alt' => '']);
							echo '</div>';
							$count++;
						endforeach;
					?>
				</div>

				<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			<?php endif; ?>

		</div>
		<div class="col-md-6">
			<?php
				if($object->type == 'achado')
					$class = "achado";
				else
					$class = "perdido";
			?>
			<div class="thumbnail-type <?php echo $class; ?>">
				<p><?= $object->type; ?></p>
			</div>
			<div class="item-name">
				<h2><?= $object->name; ?></h2>
			</div>
			<div class="item-descri">
				<?= $object->description; ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="item-page-title">
				<h2>Local do Ocorrido</h2>
			</div>
			<div id="myMap"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="item-page-title">
				<h2>Comentários</h2>
			</div>
			<div class="comentarios-wrap">
				<?= $this->Form->button(__('<i class="fa fa-fw fa-lg fa-comments"></i> Fazer Comentário'), ['class' => 'btn btn-primary icon-btn', 'data-toggle' => 'modal', 'data-target' => '#myModal', 'escape' => false]) ?>
				<div style="clear:both"></div>
				<?php if (!empty($object->comments)): ?>
						<?php foreach ($object->comments as $comments): ?>
							<div class="comentario">
								<div class="row">
									<div class="col-md-2">
										<p id="icon"><i class="fa fa-user-circle" aria-hidden="true"></i></p>
									</div>
									<div class="col-md-10">
										<p id="comment-name"><?= $comments->name; ?> - <span id="comment-date"><?= $comments->created; ?></span></p>
										<div class="comentario-text">
											<?= $comments->comment; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
        	<h4 class="modal-title">Formulário para realizar comentários</h4>
      </div>
      <div class="modal-body">
			<div class="comment-form">
				<?= $this->Form->create('Comments', ['url' => ['controller' => 'Comments', 'action' => 'addComment']]) ?>
					<div class="row">
						<div class="col-md-6">
							<?php echo $this->Form->control('name', ['label' => 'Nome', 'class' => 'form-control']); ?>
						</div>
						<div class="col-md-6">
							<?php echo $this->Form->control('email', ['label' => 'E-mail', 'class' => 'form-control']);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php echo $this->Form->control('object_id', ['type' => 'hidden', 'value' => $object->id]); ?>
							<?php echo $this->Form->control('status', ['type' => 'hidden', 'value' => 0]); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php echo $this->Form->control('comment', ['type' => 'textarea', 'label' => 'Comentário', 'class' => 'form-control']); ?>
						</div>
					</div>
				<center><?= $this->Form->button(__('<i class="fa fa-fw fa-lg fa-check-circle"></i> Comentar'), ['class' => 'btn btn-primary icon-btn', 'escape' => false]) ?></center>
				<?= $this->Form->end() ?>
			</div>
      </div>
      <div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar Formulário</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    var map;
    var marker;
    var myLatlng = new google.maps.LatLng(<?= $object->latitude; ?>,<?= $object->longitude; ?>);
    var geocoder = new google.maps.Geocoder();
    var infowindow = new google.maps.InfoWindow();
    function initialize(){
		var mapOptions = {
			zoom: 18,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

		marker = new google.maps.Marker({
			map: map,
			position: myLatlng,
			draggable: false
		});

		geocoder.geocode({'latLng': myLatlng }, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						infowindow.setContent(results[0].formatted_address);
						infowindow.open(map, marker);
					}
			}
		});

    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
