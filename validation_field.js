      function fMasc(objeto,mascara) {
        obj=objeto
        masc=mascara
        setTimeout("fMascEx()",1)
      }
        function fMascEx() {
        obj.value=masc(obj.value)
      }
      function mTel(tel) {
        tel=tel.replace(/\D/g,"")
        tel=tel.replace(/^(\d)/,"($1")
        tel=tel.replace(/(.{3})(\d)/,"$1)$2")
         if(tel.length == 9) {
            tel=tel.replace(/(.{1})$/,"-$1")
          } else if (tel.length == 10) {
              tel=tel.replace(/(.{2})$/,"-$1")
          } else if (tel.length == 11) {
              tel=tel.replace(/(.{3})$/,"-$1")
          } else if (tel.length == 12) {
              tel=tel.replace(/(.{4})$/,"-$1")
          } else if (tel.length > 12) {
              tel=tel.replace(/(.{4})$/,"-$1")
          }
            return tel;
      }
      function mCNPJ(cnpj){
        cnpj=cnpj.replace(/\D/g,"")
        cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
        cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
        cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
        cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
        return cnpj
      }

      function mCPF(cpf){
        cpf=cpf.replace(/\D/g,"")
        cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
        cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
        cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
        return cpf
      }
      function mCEP(cep){
        cep=cep.replace(/\D/g,"")
        cep=cep.replace(/^(\d{5})(\d)/,"$1-$2")
        return cep
      }
      // function mNum(num){
      //   num=num.replace(/\D/g,"")
      //   return num
      // }

      function mRG(rg) {
        rg=rg.replace(/\D/g,"")
        rg=rg.replace(/(\d{7})(\d)/,"$1-$2")
        return rg
      }

      function SenhaRep() {
        pwd0 = document.getElementById('pwd').value;
        pwd1 = document.getElementById('repSenha').value;

        if(pwd0 != pwd1) {
          document.getElementById('pwd').style.border="solid 1px #ff0000";
          document.getElementById('repSenha').style.border="solid 1px #ff0000";
          alert('Senha diferentes!');
          document.getElementById('repSenha').value=null;
          // document.getElementById('enviar').disabled='true';
        }else {
          document.getElementById('pwd').style.border="solid 1px #999999";
          document.getElementById('repSenha').style.border="solid 1px #999999";
        }
      }


      function red() {
        var tipo = document.getElementById('tipo').value;
        if (tipo == 1) {
          // window.location.href='index.php';
        }else
          if (tipo == 2) {
            // window.location.href='index.php?';
          }else
            if(tipo == 3) {
              // alert('Você será direcionado para o cadastro de empresa');
            window.location.href='include/formEmpresa.php';
            // window.open("include/formEmpresa.php");
          }else
            if(tipo == 9) {
              window.location.href='../index.php';
            }
      }

      function mTipo() {
        var nome = document.getElementById('nome').value;
        var n = nome.length; 
        var tipo = document.getElementById('tipo').value;

       if ((n > 0) && (tipo == 0)) {
        document.getElementById('resp').innerHTML = "Selecione um tipo para continuar o cadastro.";
        document.getElementById('tipo').style.border = "1px solid red";
       } else
        if(tipo != 0) {
          document.getElementById('resp').innerHTML = "";
          document.getElementById('tipo').style.border = "1px solid #999999";
        }
      }