<?php
  $recebe = @$_GET['nome'];
  $n = $_GET['n'];

  if($n == '1') {
    
  $sql = "SELECT a.alu_matricula, a.aludt_nasc, a.alu_dt_criacao, a.alu_nome, c.cur_nome, p.pro_nome FROM aluno_curso al
      INNER JOIN aluno a on al.alu_matricula = a.alu_matricula
      INNER JOIN curso c on al.cur_id = c.cur_id 
      INNER JOIN professor p on c.pro_id = p.pro_id WHERE al.alu_matricula LIKE '%$recebe%' ORDER BY a.alu_nome ASC";

  } else 
        if($n == '2'){

    $sql = "SELECT a.alu_matricula, a.aludt_nasc, a.alu_dt_criacao, a.alu_nome, c.cur_nome, p.pro_nome FROM aluno_curso al
      INNER JOIN aluno a on al.alu_matricula = a.alu_matricula
      INNER JOIN curso c on al.cur_id = c.cur_id 
      INNER JOIN professor p on c.pro_id = p.pro_id ORDER BY a.alu_nome ASC";

  }

  define('FPDF_FONTPATH', 'font/');
  require('connectionFactory/connection.php');
  require('fpdf/fpdf.php');
  require('fpdf/libre_fpdf.php');

  $pdf = new PDF('P','mm','A4');
  // $pdf->Open();
  $pdf->AliasNbPages('{pages}');
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 10);

  $exe_sql = mysqli_query($mysqli, $sql) or die(mysqli_error());

  $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 7, "Matricula", 1, 0, "L"); //Largura/Altura/
    $pdf->Cell(50, 7, "Aluno", 1, 0, "L");
    $pdf->Cell(40, 7, utf8_decode("Curso"), 1, 0, "L");
    $pdf->Cell(45, 7, "Professor(a)", 1, 0, "L");
    $pdf->Cell(35, 7, "Data da Matricula", 1, 1, "L");

  //Table with 20 rows and 4 columns
  $pdf->SetWidths(array(20,50,40,45,35));//CADA VALOR DESTE ARRAY SERÁ A LARGURA DE CADA COLUNA
  $pdf->SetFont('Arial', '', 10);
  // srand(microtime()*1000000);
  for($i=0;$i<20;$i++) {
    while($resultado = mysqli_fetch_array($exe_sql)){
      $matricula = utf8_decode($resultado["alu_matricula"]);
      $aluno  = utf8_decode($resultado["alu_nome"]);
      $curso = utf8_decode($resultado["cur_nome"]);
      $professor= utf8_decode($resultado["pro_nome"]);
      $data  = date('d-m-Y', strtotime ($resultado["alu_dt_criacao"]));

    $pdf->Row(array("$matricula","$aluno","$curso","$professor", "$data"));
  }
}
  
  $pdf->Output();
   
?>