<?php header('Content-Type: text/html; charset=iso-8859-1'); ?>

<?php

echo "<script> document.getElementById('no').style.display = 'none'; </script>";

?>

<?php include_once('connection.php');
	
	$palavra = $_POST['palavra'];

	$sql = "SELECT a.alu_matricula, a.aludt_nasc, a.alu_dt_criacao, a.alu_nome, c.cur_nome, p.pro_nome FROM aluno_curso al
			INNER JOIN aluno a on al.alu_matricula = a.alu_matricula
			INNER JOIN curso c on al.cur_id = c.cur_id 
			INNER JOIN professor p on c.pro_id = p.pro_id WHERE alu_nome LIKE '%$palavra%'";

	$query = mysqli_query($mysqli, $sql);

	$qtd = mysqli_num_rows($query);

?>

<section class="panel col-sm-9">

	<header class="panel-heading">
		Dados da busca:
	</header>
	<?php
	
		if( $qtd > 0 ) {

	?>
	<table class="table table-striped table-advance table-hover">

		<tbody>

			<tr>

				<th><i class="icon_profile"></i>ID</th>
				<th><i class="icon_profile"></i>Nome</th>
				<th><i class="icon_profile"></i>Data de Nascimento</th>
				<th><i class="icon_profile"></i>Curso</th>
				<th><i class="icon_profile"></i>Professor(a)</th>
				<th><i class="icon_profile"></i>Data da Matricula</th>

			</tr>

			<?php
			
				while($linha = mysqli_fetch_assoc($query)) {

			?>
			<tr>
				<td>
				<a href="gerar_pdf.php?nome=<?=$linha['alu_matricula']?>&n=1" target="_blank">
					<?=$linha['alu_matricula'];?></a>
				</td>
				<td><?=$linha['alu_nome'];?></td>
				<td><?= date('d/m/Y', strtotime($linha['aludt_nasc'])); ?></td>
				<td><?= utf8_decode($linha['cur_nome']);?></td>
				<td><?=utf8_decode($linha['pro_nome']);?></td>
				<td><?= date('d/m/Y', strtotime($linha['alu_dt_criacao']));?></td>

			</tr>
			<?php } ?>

		</tbody>
		
	</table>
	<?php } else { ?>
		<h4>Nenhum aluno registrado com esse nome.</h4>
	<?php } ?>

	<?php 

		include_once('btn-primary.php');

	?>
</section>