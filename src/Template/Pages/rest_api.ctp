<div class="row">
	<div class="col-md-12">
		<center><h1>Documentação Rest API</h1></center>
	</div>
</div>			
<div class="jumbotron">
	<div class="row">
		<div class="col-md-12">
			<center><h2>Instruções de utilização</h2></center>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-12">
			<h3>URL para requisições: <span class="label label-default">http://achamoseperdemos.com/datamaps</span></h3>
			<h3>Formato dos dados retornados via Json</h3>
				<table class="table">
					<thead>
						<tr>
							<th>Atributo</th>
							<th>Descrição<th>
						</tr>	
					</thead>		
					<tr>
						<td>id</td>
						<td>O atributo id de identificação do objeto. Todos os objetos possuem um id de identificação único.</td>
					</tr>
					<tr>	
						<td>name</td>
						<td>O atributo name é o nome de identificação cadastrado pelos usuários.</td>
					</tr>
					<tr>	
						<td>type</td>
						<td>O atributo type indica a situação do objeto. Ele indica se o objeto foi perdido ou se ele foi encontrado por alguém.</td>
					</tr>
					<tr>	
						<td>latitude</td>
						<td>O atributo latitude indica a latitude do local onde o objeto foi perdido ou encontrado.</td>
					</tr>
					<tr>	
						<td>longitude</td>
						<td>O atributo longitude indica a longitude do local onde o objeto foi perdido ou encontrado.</td>
					</tr>	
				</table>
			</div>
		</div>			
	</div>	
<div class="jumbotron">	
	<div class="row">
		<h2>Exemplo - JavaScript</h2>
		<div class="col-md-12">
			<h3>Código</h3>
			<p id="instructions">1. Queremos saber o nome, status, latitude e a longitude dos objetos fornecidos pela Rest API.</p>
			<p id="instructions">2. Iremos utilizar uma aplicação Javascript para fazer uma requisição via AJAX na URL HTTP onde a aplicação fornece dados.</p>
			<p id="instructions">3. A aplicação irá devolver em resposta à solicitação HTTP dados em formato Json.</p> 
			<p id="instructions">4. Utilizaremos a função Jquery $.parseJSON() para fazer o parser do Json e transformar em um array de objetos Javascript dentro de um loop $.each().</p>
			<p id="instructions">5. Iremos gerar uma tabela com todos as informações desejadas e colocar dentro do corpo HTML da página</p>
			<pre class="brush: js;">
				$.ajax({
					type:"POST",
					url:"http://achamoseperdemos.com/datamaps",
					success: function(data){
						var table = "&lt;table class='table'&gt;&lt;thead&gt;&lt;tr&gt;&lt;th&gt;Nome do Objeto&lt;/th&gt;&lt;th&gt;Tipo do Objeto&lt;/th&gt;&lt;th&gt;Latitude&lt;/th&gt;&lt;th&gt;Longitude&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;";
						$.each(data, function(index, ponto) {
							table += "&lt;tr&gt;&lt;td&gt;" + ponto.name + "&lt;/td&gt;&lt;td&gt;" + ponto.type + "&lt;/td&gt;&lt;td&gt;" + ponto.latitude + "&lt;/td&gt;&lt;td&gt;" + ponto.longitude + "&lt;/td&gt;&lt;/tr&gt;";
						});
						table += "&lt;/table";
						$("#records_table").append(table);
					},
					error: function () {
						alert('error');
					}
				});
			</pre>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3>Resultado</h3>
			<div id="records_table"></div>
		</div>
	</div>	
</div>
<div class="jumbotron">	
	<div class="row">
		<h2>Exemplo - PHP</h2>
		<div class="col-md-12">
			<h3>Código</h3>
			<p id="instructions">1. Queremos saber o nome, status, latitude e a longitude dos objetos fornecidos pela Rest API.</p>
			<p id="instructions">2. Iremos utilizar uma aplicação PHP para fazer uma requisição HTTP onde a aplicação fornece dados.</p>
			<p id="instructions">3. A aplicação irá devolver em resposta à solicitação HTTP dados em formato Json.</p> 
			<p id="instructions">4. Utilizaremos a função PHP json_decode() para fazer o parser do Json e transformar em um array de objetos PHP.</p>
			<p id="instructions">5. Iremos gerar uma tabela com todos as informações desejadas e colocar dentro do corpo HTML da página</p>
			<pre class="brush: php;">
				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_RETURNTRANSFER => 1,
					CURLOPT_URL => 'http://achamoseperdemos.com/datamaps',
					CURLOPT_POST => 1,
				));

				$response = curl_exec($curl);

				curl_close($curl);

				$data = json_decode($response);

				$table = "&lt;table class='table'&gt;&lt;thead&gt;&lt;tr&gt;&lt;th&gt;Nome do Objeto&lt;/th&gt;&lt;th&gt;Tipo do Objeto&lt;/th&gt;&lt;th&gt;Latitude&lt;/th&gt;&lt;th&gt;Longitude&lt;/th&gt;&lt;/tr&gt;&lt;thead&gt;";
				if (!empty($data)):
					foreach ($data as $object):
						$table .= "&lt;tr&gt;&lt;td&gt;" . $object->name . "&lt;/td&gt;&lt;td&gt;" . $object->type . "&lt;/td&gt;&lt;td&gt;" . date("d/m/Y", strtotime($object->date)) . "&lt;/td&gt;&lt;td&gt;" . $object->latitude . "&lt;/td&gt;&lt;td&gt;" . $object->latitude . "&lt;/td&gt;&lt;/tr&gt;";
					endforeach;
				$table .= "&lt;/table&gt;";	
				endif;

				echo $table;
			</pre>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3>Resultado</h3>
			<?php
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_RETURNTRANSFER => 1,
					CURLOPT_URL => 'http://achamoseperdemos.com/datamaps',
					CURLOPT_POST => 1,
				));
				$response = curl_exec($curl);
				curl_close($curl);

				$data = json_decode($response);
				$table = "<table class='table'><thead><tr><th>Nome do Objeto</th><th>Tipo do Objeto</th><th>Data do ocorrido</th><th>Latitude</th><th>Longitude</th></tr><thead>";
				if (!empty($data)):
					$count = 0;
					foreach ($data as $object):
						$count ++;
						$table .= "<tr><td>" . $object->name . "</td><td>" . $object->type . "</td><td>" . date("d/m/Y", strtotime($object->date)) . "</td><td>" .$object->latitude . "</td><td>" . $object->latitude . "</td></tr>";
						if($count === 5){
							break;
						}
					endforeach;
				$table .= "</table";	
				endif; 
			?>
			<div class="php-table">
				<?= $table; ?>
			</div>
		</div>
	</div>	
</div>		
<script>
	$.ajax({
		type:"POST",
		url:"http://achamoseperdemos.com/datamaps",
		success: function(data){
			var table = "<table class='table'><thead><tr><th>Nome do Objeto</th><th>Tipo do Objeto</th><th>Latitude</th><th>Longitude</th></tr></thead>";
			var count = 0;
			$.each(data, function(index, ponto) {
				count++;
				table += "<tr><td>" + ponto.name + "</td><td>" + ponto.type + "</td><td>" + ponto.latitude + "</td><td>" + ponto.longitude + "</td></tr>";
				if(count === 5){
					return false;
				}
			});
			table += "</table>";
			$("#records_table").append(table);
		},
		error: function () {
			alert('error');
		}
	});
</script>