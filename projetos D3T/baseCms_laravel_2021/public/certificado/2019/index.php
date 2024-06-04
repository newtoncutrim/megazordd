<!DOCTYPE html>
<html>
<head>
	<title>
		Evento HOJE 2019
	</title>
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<script type="text/javascript">
	window.onload = function() {
		$(document).ready(function(){
		  	$('.codigo').mask('AA-A9A9-99');
		});
	};
</script>
<style type="text/css">
	body{
		color: #fff;
	}
</style>
</head>
<body style="background-color: #ec0e51">
	<center>
		<h3>Digite o código do seu passaporte do HOJE 2019:</h3>
		<small>Ele está impresso no seu crachá ;)</small>
		<br><br>
		<?php 
			if(isset($_GET['s'])){
		 ?>
		<div class="alert alert-info" style="max-width: 400px" role="alert">
			Código que você digitou não foi encontrado :(
		</div>
		<?php } ?>
		<form method="get" action="certificado.php">
			<input required="" type="text" name="codigo" class="codigo" style="width: 300px; height: 80px; border-radius: 5px; text-transform: uppercase; color:red; border: 1px solid #7e7e7e; font-size: 45px; text-align: center;" placeholder="__-____-__">
			<div>
				<br><br>
			</div>
			<button type="submit" class="btn btn-success">
				Ver meu certificado
			</button>
		</form>
	</center>
</body>
</html>