<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card">
    <div class="card-body">
        <div class="objects form large-9 medium-8 columns content">
            <?= $this->Form->create($object, ['type'=>'file']) ?>
            <fieldset>
                <legend><?= __('Adicionar Objeto') ?></legend>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $this->Form->control('name', ['label' => 'Nome do Objeto', 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('type', ['options' => ['encontrado' => 'Encontrado', 'perdido' => 'Perdido'], 'label' => 'Tipo do Objeto', 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('solved', ['options' => ['0' => 'Não', '1' => 'Sim'], 'label' => 'Caso solucionado?', 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $this->Form->control('user_id', ['options' => $users, 'label' => 'Nome do Usuário', 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('date', ['empty' => true, 'label' => 'Data do Ocorrido', 'type' => 'text', 'id' => 'demoDate', 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('categories._ids', ['options' => $categories, 'label' => 'Nome da Categoria', 'class' => 'form-control', 'id' => 'demoSelect']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $this->Form->control('uploadfile[]', ['type' => 'file', 'multiple' => 'true', 'label' => 'Selecione as fotos do objeto']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <center><h3>Clique e arraste o marcador</h3></center>
                        <div id="myMap"></div>
                        <?php echo $this->Form->control('address', ['label' => 'Endereço do Local', 'class' => 'form-control', 'id' => 'address', 'readonly']); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?php echo $this->Form->control('latitude', ['label' => 'Latitude do Local', 'class' => 'form-control', 'id' => 'latitude', 'readonly']); ?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $this->Form->control('longitude', ['label' => 'Longitude do Local', 'class' => 'form-control', 'id' => 'longitude', 'readonly']); ?>
                            </div>
                        </div>        
                    </div>
                </div>      
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $this->Form->control('description', ['label' => 'Descrição do Ocorrido', 'class' => 'form-control']); ?>
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
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'description', {
    	language: 'pt-BR',
	});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVRMJ5qy_sr21AgOrGm1Wq5cxWQJvm4nk"></script>
<script type="text/javascript"> 
    var map;
    var marker;
    var myLatlng = new google.maps.LatLng(-20.502524,-54.613458); 
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
            icon: '../webroot/img/marcador.png',
            draggable: true 
        });     
        
        geocoder.geocode({'latLng': myLatlng }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#address').val(results[0].formatted_address);
                    $('#latitude').val(marker.getPosition().lat());
                    $('#longitude').val(marker.getPosition().lng());
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }
            }
        });

                        
        google.maps.event.addListener(marker, 'dragend', function() {

        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#address').val(results[0].formatted_address);
                    $('#latitude').val(marker.getPosition().lat());
                    $('#longitude').val(marker.getPosition().lng());
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }
            }
        });
    });
    
    }
    
    google.maps.event.addDomListener(window, 'load', initialize);
</script>      