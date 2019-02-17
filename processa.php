<?php
	
	$tag = $_POST['tag'];

	if(isset($tag) && $tag !== '') {
		if($tag == 'enviar') {
			include_once('connection.php');
			$id = 0;
			$nome = strtoupper($_POST['nome']);
			$data = $_POST['dt_nasc'];
			$dt_criacao = date('Y-m-d');

				$sql = "INSERT INTO professor (pro_nome, pro_dt_nasc, pro_dt_criacao) VALUES ('$nome', '$data', '$dt_criacao')";

				if(mysqli_query($mysqli, $sql)) {
					echo true;
				}else {
					echo false;
				}
		}
	}
?>