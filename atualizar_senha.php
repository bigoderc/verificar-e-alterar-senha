<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title> Atualizar senha </title>
	<link rel="stylesheet" href="/WEB/css/css.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script>
		// JS que exibe uma mensagem personalizada depois da atualização
		function exibirNome() {
		    var nome = document.querySelector("#nome").value;
		    if (nome) {
		    	alert("A senha do funcionário(a) " + nome + " foi atualizada com sucesso!");
		  	}
		}
	</script>
	<script>
		function mostrarSenha() {
			// JS do font-awesome para campo de Senha atual
	  		var tipo = document.getElementById('senha')
	  		document.getElementById('pass').addEventListener('click', () => {
		    if (tipo.value) {
		      tipo.type == 'password' ? tipo.type = 'text' : tipo.type = 'password';
		      tipo.focus()
		      document.getElementById('pass').style.display = 'none';
		      document.getElementById('text').style.display = 'inline-block';
		    }
	  	  })

		  document.getElementById('text').addEventListener('click', () => {
		    if (tipo.value) {
		      tipo.type == 'text' ? tipo.type = 'password' : tipo.type = 'text';
		      tipo.focus()
		      document.getElementById('text').style.display = 'none';
		      document.getElementById('pass').style.display = 'inline-block';
		    }
		  })
		}
	
		function mostrarNovaSenha() {
		  // JS do font-awesome para campo de Nova senha
		  var tipo2 = document.getElementById('senha_nova')
		  document.getElementById('pass1').addEventListener('click', () => {
		    if (tipo2.value) {
		      tipo2.type == 'password' ? tipo2.type = 'text1' : tipo2.type = 'password';
		      tipo2.focus()
		      document.getElementById('pass1').style.display = 'none';
		      document.getElementById('text1').style.display = 'inline-block';
		    }
		  })
		  document.getElementById('text1').addEventListener('click', () => {
		    if (tipo2.value) {
		      tipo2.type == 'text1' ? tipo2.type = 'password' : tipo2.type = 'text1';
		      tipo2.focus()
		      document.getElementById('text1').style.display = 'none';
		      document.getElementById('pass1').style.display = 'inline-block';
		    }
		  })
		}
	
		function mostrarConfirmarSenha() {
		  // JS do font-awesome para campo de Redigite a nova senha
		  var tipo3 = document.getElementById('confirmar_senha')
		  document.getElementById('pass2').addEventListener('click', () => {
		    if (tipo3.value) {
		      tipo3.type == 'password' ? tipo3.type = 'text2' : tipo3.type = 'password';
		      tipo3.focus()
		      document.getElementById('pass2').style.display = 'none';
		      document.getElementById('text2').style.display = 'inline-block';
		    }
		  })
		  document.getElementById('text2').addEventListener('click', () => {
		    if (tipo3.value) {
		      tipo3.type == 'text2' ? tipo3.type = 'password' : tipo3.type = 'text2';
		      tipo3.focus()
		      document.getElementById('text2').style.display = 'none';
		      document.getElementById('pass2').style.display = 'inline-block';
		    }
		  })
		}
		
	</script>
	<script>
		// JS que cria uma legenda personalizada em campo do formulário depois que o funcionário é escolhido
		function onChangeSelect(select) {
			document.getElementById("cd_funcionario").title = "Você escolheu o funcionário " + select.selectedOptions[0].textContent;         
   			document.getElementById("senha_atual").title = "Campo para inserir a senha atual de " + select.selectedOptions[0].textContent;
   			document.getElementById("senha_nova").title = "Campo para inserir a nova senha de " + select.selectedOptions[0].textContent;
   			document.getElementById("confirmar_senha").title = "Campo para inserir novamente a nova senha de " + select.selectedOptions[0].textContent;
   			document.getElementById("botao").title = "Botão para atualizar a senha de " + select.selectedOptions[0].textContent;
		}
	</script>
	
</head>
<body>
	<?php
		// Inclusão do arquivo conexao.php ao update_funcionario.php
		require_once '../conexao/conexao.php';  
		// Se existir o botão de Atualizar
		if(isset($_POST['Atualizar'])){
			// Especifica a variável 
			$cd_funcionario = $_POST['cd_funcionario'];
			$senha = $_POST['senha']; 
			$senha_nova = $_POST['senha_nova'];
			$confirmar_senha = $_POST['confirmar_senha'];
			// Faz a seleção das senhas dos funcionário pelo ID
			$selecao = "SELECT senha FROM funcionario WHERE senha = '$cd_funcionario'";
			// $seleciona_dados recebe $conexao que prepare a operação para selecionar
    		        $seleciona_dados = $conexao->prepare($selecao);
    		        // Vincula um valor a um parâmetro
    		        $seleciona_dados->bindValue(':cd_funcionario',$cd_funcionario);
			$seleciona_dados->bindValue(':senha',$senha);
			$seleciona_dados->bindValue(':senha_nova',$senha_nova);
			$seleciona_dados->bindValue(':confirmar_senha',$confirmar_senha);
			// Executa a operação
			$seleciona_dados->execute();
			// Retorna uma matriz contendo todas as linhas do conjunto de resultados
			$linhas = $seleciona_dados->fetchAll(PDO::FETCH_ASSOC);
			print_r($linhas); // Retorna Array () no navegador
			$senha_mysql = $linhas[0]['senha'];

			try {
				// Se a $senha_atual for diferente de $senha_mysql e a $senha_nova for diferente de $confirmar_senha
				if (($senha != $senha_mysql) || ($senha_nova != $confirmar_senha)){
						echo "Senha inválida, tente novamente";
				// Senão
				}else{
					if ($update = "UPDATE funcionario SET senha = '$confirmar_senha' WHERE cd_funcionario = '$cd_funcionario'") {
           				echo "Senha atualizada com sucesso!";
            		}
				}	
			} catch (PDOException $falha_alteracao) {
				echo "A alteração da senha não foi feita".$falha_alteracao->getMessage();
			}			
		}
		// Query que seleciona chave e nome do funcionário
		$seleciona_nomes = $conexao->query("SELECT cd_funcionario, nome FROM funcionario");
		// Resulta em uma matriz
		$resultado_selecao = $seleciona_nomes->fetchAll();	
	?>
	<form method="POST" onsubmit="exibirNome()">
		<p> Funcionário:
		<select onchange="onChangeSelect(this)" id="cd_funcionario" name="cd_funcionario" required="" title="Caixa de seleção para escolher o funcionário a ser atualizado">
			<option value="" title="Opção vazia, escolha abaixo o funcionário a ser atualizado"> </option>
  			<?php
    			foreach ($resultado_selecao as $valor) {
					echo "<option value='{$valor['cd_funcionario']}'>{$valor['nome']}</option>";
				}
			?>
		</select>
		</p>
		<p> Senha atual:
  		<input type="password" name="senha" id="senha" title="Campo para inserir a antiga senha de login do funcionário" size="30" maxlength="32" required="" onclick="mostrarSenha()">
  		<i class="fa fa-eye" id="text" aria-hidden="true" title="Ocultar senha atual"></i>
  		<i class="fa fa-eye-slash" id="pass" aria-hidden="true" title="Mostrar senha atual"></i>
		</p>
		<p> Nova senha:
  		<input type="password" name="senha_nova" id="senha_nova" title="Campo para inserir a nova senha de login do funcionário" size="30" maxlength="32" required="" onclick="mostrarNovaSenha()">
  		<i class="fa fa-eye" id="text1" aria-hidden="true" title="Ocultar a nova senha"></i>
  		<i class="fa fa-eye-slash" id="pass1" aria-hidden="true" title="Mostrar a nova senha"></i>
		</p>
		<p> Redigite a nova senha:
  		<input type="password" name="confirmar_senha" id="confirmar_senha" title="Campo para inserir novamente a nova senha de login do funcionário" size="30" maxlength="32" required="" onclick="mostrarConfirmarSenha()">
  		<i class="fa fa-eye" id="text2" aria-hidden="true" title="Ocultar a nova senha"></i>
  		<i class="fa fa-eye-slash" id="pass2" aria-hidden="true" title="Mostrar a nova senha"></i>
		</p>
		<button name="Atualizar" id="botao" title="Botão para atualizar a senha do funcionário">Atualizar senha</button>
	</form>
</body>
</html>
