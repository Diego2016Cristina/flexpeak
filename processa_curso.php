<?php
	
	$tag = $_POST['tag'];

	if(isset($tag) && $tag !== '') {
		if($tag == 'enviar') {
			include_once('connection.php');
			$id = 0;
			$nome = strtoupper($_POST['nome_curso']);
			$dt_criacao = date('Y-m-d');
			$id_pro = $_POST['f_developer'];

				$sql = "INSERT INTO curso (cur_nome, cur_dt_criacao, pro_id) VALUES ('$nome', '$dt_criacao', '$id_pro')";

				if(mysqli_query($mysqli, $sql)) {
					echo true;
				}else {
					echo false;
				}
		}
	}
?>