<?php
	
	$tag = $_POST['tag'];

	if(isset($tag) && $tag !== '') {
		if($tag == 'enviar') {
			include_once('connection.php');
			$matricula              = $_POST['matricula'];
			$nome            = strtoupper($_POST['nome_aluno']);
			$dt_nasc         = $_POST['dt_nasc'];
			$cep             = $_POST['cep'];
			$logradouro      = strtolower($_POST['logradouro']);
			$bairro          = strtolower($_POST['bairro']);
			$numero          = $_POST['numero'];
			$cidade          = strtolower($_POST['cidade']);
			$estado          = strtolower($_POST['estado']);
			$alu_dt_criacao  = date('Y-m-d');
			$cur_id          = $_POST['f_developer'];

				$sql = "INSERT INTO aluno (alu_matricula, alu_nome, aludt_nasc, alu_rua, alu_numero, alu_bairro, alu_cidade, alu_estado, alu_dt_criacao, alu_cep) VALUES ('$matricula', '$nome', '$dt_nasc', '$logradouro', '$numero', '$bairro', '$cidade', '$estado',  '$alu_dt_criacao', '$cep')";

				$ql = "INSERT INTO aluno_curso (cur_id, alu_matricula) VALUES ('$cur_id', '$matricula')";

				if(mysqli_query($mysqli, $sql)) 
					if(mysqli_query($mysqli, $ql)) {

					echo true;

				}else {

					echo false;

				}
		}
	}
?>