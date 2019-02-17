<?php
	include_once('connectionFactory/connection.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<title>Formulário</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/ajax.googleapis.com.js"></script>
	<script type="text/javascript" src="js/validation_field.js"></script>

</head>
<!-- script CEP -->
<script type="text/javascript">
    $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#logradouro").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");
                        $("#ibge").val("...");
                        document.getElementById('cep').style.border="solid 1px #999999";

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#logradouro").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                                document.getElementById('cep').style.border="solid 1px #ff0000";
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                        document.getElementById('cep').style.border="solid 1px #ff0000";
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

// verificação de Selecione
      function mSeleNull() {
        var op = document.getElementById('cur_op').value;
        var curso = document.getElementById('nome_curso').value;

        var n = curso.length;

        if( (n > 0) && (op == 'selecione') ) {

          document.getElementById('resp_cur').innerHTML = "Selecione um professor(a) para continuar o cadastro.";
          document.getElementById('cur_op').style.border = "1px solid red";
          document.getElementById('messag_cur').style.display = 'none';
          document.getElementById('resp_cur').style.display = 'inline-block';

        } else 
        if( (n > 0) && (op != 'selecione') ) {
          
          document.getElementById('cur_op').style.border = "1px solid #999999";
          document.getElementById('messag_cur').style.display = 'inline-block';
          document.getElementById('resp_cur').style.display = 'none';

        }

      }


 </script>
 <style type="text/css">
 	input {
 		text-transform: uppercase;
 	}
  #resp_cur {
    display: none;
  }
  #no {
    position: relative; top: 10px; display: inline-block;
  }
 </style>
<body>
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<h3>FORMULÁRIO DE CADASTRO</h3>
			<div role="tabpanel">

				<ul class="nav nav-tabs" role="tablist">

					<li role="presentation" class="active">
						<a href="#seccion1" aria-controls="seccion1" data-toggle="tab" role="tab">CAD. PROFESSOR</a></li>

					<li role="presentation">
						<a href="#seccion2" aria-controls="seccion2" data-toggle="tab" role="tab">CAD. CURSO</a></li>

					<li role="presentation">
						<a href="#seccion3" aria-controls="seccion3" data-toggle="tab" role="tab">CAD. ALUNO</a></li>

          <li role="presentation">
            <a href="#seccion4" aria-controls="seccion4" data-toggle="tab" role="tab">FORMULÁRIO</a></li>

				</ul>

				<div class="tab-content">

					<div role="tabpanel" class="tab-pane active" id="seccion1">

						<form class="form_pro">

				            <h3>Preencha o formulário</h3>

				            <div class="form-group">
				              <label for="nome">Nome completo</label>
				              <input type="text" class="form-control" name="nome" id="nome" placeholder="nome" required>
				            </div>

				            <div class="form-group">
				              <label for="dt_nasc">Data de Nascimento</label>
				              <input type="date" class="form-control" name="dt_nasc" id="dt_nasc" placeholder="data de nascimento" required>
				            </div>

				            <input type="submit" name="" class="btn btn-primary" value="enviar">
				            <i class="fa fa-reflesh fa-spin iconeRefresh"><img src="img/refresh.gif" width="5%"></i>

				        </form>

				          <span class="messag"></span>

					</div>

				<div role="tabpanel" class="tab-pane" id="seccion2">
					<form class="form_cur">

				            <h3>Preencha o formulário</h3>

				            <div class="form-group">
				              <label for="nome_curso">Curso</label>
				              <input type="text" class="form-control" name="nome_curso" id="nome_curso" placeholder="curso" required>
				            </div>

				            <div class="form-group">

				            	<select name="f_developer" class="form-control" id="cur_op" onblur="mSeleNull
mSeleNull();">
				            	  <OPTION value="selecione">SELECIONE UM PROFESSOR(A)</OPTION> 
                          <?php
		                        $sql = "SELECT * FROM professor ORDER BY pro_nome ASC";
		                        $res = mysqli_query($mysqli, $sql);
		           		            
		                        while($row = mysqli_fetch_assoc($res)){

		                          echo '<option value="'.$row['pro_id'].'">'.$row['pro_nome'].'</option>';

		                        }

	                        ?>
                      </select>
				            </div>
                    <!-- mensagem de callbeck -->
                    <div class="alert alert-success" role="alert" id="resp_cur"></div><br/>

				            <input type="submit" name="" class="btn btn-primary" value="enviar" id="btn-cur" onclick="mSeleNull();">
				            <i class="fa fa-reflesh fa-spin iconeRefresh"><img src="img/refresh.gif" width="5%"></i>

				    </form>

				        <span class="messag_curso" id="messag_cur"></span>

				</div>

				<div role="tabpanel" class="tab-pane" id="seccion3">

					<h3>Preencha o formulário</h3>

					<form class="form_alu">

                <div class="form-group">
                      <label for="matricula">Numero da Matricula</label>
                      <input type="text" class="form-control" name="matricula" id="matricula" placeholder="matrícula com 6 digitos numericos" maxlength="6" minlength="6" required oninvalid="setCustomValisity('Somente numero diego');">
                </div>

						    <div class="form-group">
				              <label for="nome_aluno">Nome completo</label>
				              <input type="text" class="form-control" name="nome_aluno" id="nome_aluno" placeholder="aluno" required>
				        </div>

				        <div class="form-group">
			              <label for="dt_nasc">Data de Nascimento</label>
			              <input type="date" class="form-control" name="dt_nasc" id="dt_nasc" placeholder="data de nascimento" required>
			            </div>

			            <div class="form-group">
			            	<label class="cep">CEP</label>
			            	<input type="text" name="cep" id="cep" class="form-control" placeholder="cep" maxlength="9" onkeydown="javascript: fMasc( this, mCEP);" alt="Endereço" required>
			            </div>

			            <div class="form-group">
			            	<label class="logradouro">Logradouro</label>
			            	<input type="text" name="logradouro" id="logradouro" class="form-control" placeholder="logradouro" required>
			            </div>

			            <div class="form-group">
			            	<label class="bairro">Bairro</label>
			            	<input type="text" name="bairro" id="bairro" class="form-control" placeholder="bairro" required>
			            </div>

			            <div class="form-group">
			            	<label class="numero">Nº</label>
			            	<input type="text" name="numero" id="numero" class="form-control" placeholder="nº da residência" required>
			            </div>

			            <div class="form-group">
			            	<label class="cidade">Cidade</label>
			            	<input type="text" name="cidade" id="cidade" class="form-control" placeholder="cidade" required>
			            </div>

			            <div class="form-group">
			            	<label class="estado">Estado</label>
			            	<input type="text" name="estado" id="estado" class="form-control" placeholder="estado" required>
			            </div>

			            <div class="form-group">

				            	<select name="f_developer" class="form-control">
				            	<OPTION>SELECIONE UM CURSO</OPTION> 
                                <?php
		                            $sql = "SELECT * FROM curso";
		                            $res = mysqli_query($mysqli, $sql);

		                            while($row = mysqli_fetch_assoc($res)){
		                                echo '<option value="'.$row['cur_id'].'">'.$row['cur_nome'].'</option>';
		                            }
	                            ?>
                                </select>
				            </div>

				        <input type="submit" name="" class="btn btn-primary" value="enviar">
				            <i class="fa fa-reflesh fa-spin iconeRefresh"><img src="img/refresh.gif" width="5%"></i>

					</form>

					<span class="messag_aluno"></span>

				</div>

        <div role="tabpanel" class="tab-pane" id="seccion4">

          <h3>Gerar Formulário</h3>

          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="text" name="palavra" id="palavra" class="form-control" placeholder="Buscar por aluno...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" id="busca" type="button">Buscar</button>
                  </span>
                </div>
              </div>
            </div>
            <?php
              include_once('connectionFactory/btn-primary.php');
            ?>
          </div>

          <div id="dados"></div>

        </div>

			</div>

		</div>
		<div class="col-sm-3"></div>
	</div>
</div>
</div>
</div>
</div>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
  $('.form_pro').submit(function(e) {
    e.preventDefault();

    var data = $(this).serializeArray();
    data.push({name: 'tag', value: 'enviar'});
    $.ajax({
      url: 'connectionFactory/processa.php',
      type: 'post',
      dataType: 'json',
      data: data,
      beforeSend: function() {
        $('.iconeRefresh').css('display', 'inline');
      }
    })
    .done(function() {
      $('.messag').html("Cadastrado com sucesso!");
    })
    .fail(function() {
      $('.messag').html("Erro ao tentar cadastrar.");
    })
    .always(function() {
      setTimeout(function(){
        $('.iconeRefresh').hide();
        document.getElementById('nome').value = '';
        document.getElementById('dt_nasc').value = null;
      }, 1000);
    });
  });
});

  // ajax para o cadastro do curso
  $(document).ready(function(){
  $('.form_cur').submit(function(e) {
    e.preventDefault();

    var data = $(this).serializeArray();
    data.push({name: 'tag', value: 'enviar'});
    $.ajax({
      url: 'connectionFactory/processa_curso.php',
      type: 'post',
      dataType: 'json',
      data: data,
      beforeSend: function() {
        $('.iconeRefresh').css('display', 'inline');
      }
    })
    .done(function() {
      $('.messag_curso').html("Cadastrado com sucesso!");
    })
    .fail(function() {
      $('.messag_curso').html("Erro ao tentar cadastrar.");
    })
    .always(function() {
      setTimeout(function(){
        $('.iconeRefresh').hide();
      }, 1000);
    });
  });
});


// ajax para o cadastro do aluno
  $(document).ready(function(){
  $('.form_alu').submit(function(e) {
    e.preventDefault();

    var data = $(this).serializeArray();
    data.push({name: 'tag', value: 'enviar'});
    $.ajax({
      url: 'connectionFactory/processa_aluno.php',
      type: 'post',
      dataType: 'json',
      data: data,
      beforeSend: function() {
        $('.iconeRefresh').css('display', 'inline');
      }
    })
    .done(function() {
      $('.messag_aluno').html("Cadastrado com sucesso!");
    })
    .fail(function() {
      $('.messag_aluno').html("Erro ao tentar cadastrar.");
    })
    .always(function() {
      setTimeout(function(){
        $('.iconeRefresh').hide();
      }, 1000);
    });
  });
});

// ajax buscar por aluno
function buscar(palavra) {
  var page = "connectionFactory/buscar.php";
  $.ajax ({
    type: 'POST',
    dataType: 'html',
    url: page, beforeSend: function () {
      $("#dados").html("Carregando...");
    },
    data: {palavra: palavra},
    success: function (msg) {
      $("#dados").html(msg);
    }
  });
}
$('#busca').click(function() {
    buscar($("#palavra").val())
});
</script>