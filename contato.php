<?php include("./adm/conecta.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="Grafica Colombo, Impressos graficos">
		<meta name="classification" content="Studio Midia Mix : panfletos, folders, cartoes de visita, mala direta, livros, cartazes">
		<meta name="keywords" content="Grafica Colombo, Colombo industria grafica, grafica de toledo, grafica em toledo, grafica colombo toledo, o.a. colombo,  ">
		<meta name="author" content="Studio Midia Mix - http://www.studiomidiamix.com.br">
		<meta name="title" content="Grafica Colombo">
		<meta name="resource-type" content="document">
		<meta name="robots" content="all">
		<meta name="language" content="pt-br">
		<meta name="doc-class" content="completed">
		<meta name="doc-rights" content="Public">
		<meta name="geo.placename" content="Toledo, Parana, Brazil">
		<meta name="geo.region" content="br-pr">
		<title>Colombo Comunicacao Visual</title>
		<link rel="stylesheet" type="text/css" href="estilos.css" />
		<style type="text/css">
		body {
			width:100%;
			height:100%;
			margin-left:0px;
			margin-right:0px;
			margin-bottom:0px;
			margin-top:0px;
			background-color:#2B2B2B;
		}
		</style>
		<link rel="stylesheet" href="lightbox/css/lightbox.css" type="text/css" media="screen" />
		<script src="lightbox/js/prototype.js" type="text/javascript"></script>
		<script src="lightbox/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
		<script src="lightbox/js/lightbox.js" type="text/javascript"></script>
	</head>
	<?php include("header.php"); ?>
	<body>
	<div class="degradefundo"></div>
	<div class="content" style="height:910px;"> 
				  <!-- div que gera a sombra do fundo da pagina -->
		<div class="branco" style="width:25px; height:910px; overflow:hidden;">
			<div class="branco" style="width:25px; height:433px; overflow:hidden; background-image:url(imagens/left.jpg); background-repeat:no-repeat;"></div>
		</div>
				  <!-- aqui comeca o conteudo da pagina inicial -->
		<div class="contentprincipal" style="height:910px;">
			<div class="titulocontato">
			  <h1>:: Pagina de Contato</h1>
			</div>
			<div id="containercontato">
				<form method="post">
					<?php
						if (isset($POST["nome"]))
							$nome=$POST['nome'];
						else
							$nome="";
						if (isset($POST["acao"]))
							$acao=$POST['acao'];
						else
							$acao="";
							
						if (isset ($POST["email"]))
							$email=$POST['email'];
						else
							$email="";
						$enviar=true;
					?>
							
						Nome:<br>
						<input type="text" class="inputcontato" /><?php if (($nome="")&&($acao=="enviar")) {echo "Preencha o seu nome";$enviar=false;}?>
						<br>
						<br>
						E-Mail: <br>
						<input type="text" class="inputcontato" />
							<?php 
								if (($email=="")&&($acao=="enviar"))
								{
								$tamanho=strilen($email);
									if(
										($tamanho<7)
										||
										(strrpos($email,'.')==false)
										||
										(strrpos($email,'@')==false)
									){
										echo "Peencha o email";
										$envair=false;
									}
								}
							?>
							<br>
							<br>
							<?php 
								if (isset ($POST["telefone"]))
									$telefone=$POST['telefone'];
								else 
									$telefone="";
									
								if (isset ($POST["cidade"]))
									$cidade=$POST['cidade'];
								else
									$cidade="";
									
								if (isset ($POST["mensagem"]))
									$mensagem=$POST['mensagem'];
								else
									$mensagem="";
								
							?>
						Telefone:<br>
						<input type="text" class="inputcontato" /><?php if (($telefone="")&&($acao=="enviar")) {echo "Preencha o seu telefone";$enviar=false;}?>
						<br>
						<br>
						Cidade:<br>
						<input type="text" class="inputcontato" /><?php if (($cidade="")&&($acao=="enviar")) {echo "Preencha o seu cidade";$enviar=false;}?>
						<br>
						<br>
						Mensagem:<br>
						<textarea rows="10" class="inputcontato2"></textarea><?php if (($mensagem="")&&($acao=="enviar")) {echo "Preencha o seu mensagem";$enviar=false;}?>
						<br>
						<br>
						<input id="enviar" type="submit" value="ENVIAR" />
						<input id="reset" type="reset" value="LIMPAR" />
					  </form>
							<?php if (($enviar )&&($acao=="enviar"))
								{
									$corpo = " Formulario de envio\n";
									$corpo = "Nome:" . $nome . "\n";
									$corpo = "Email:" . $email . "\n";
									$corpo = "Telefone:" . $telefone . "\n";
									$corpo = "Cidade:" . $cidade . "\n";
									$corpo = "Comentário:" . $mensagem . "\n";
									//envio o correio...
									mail("contato@gcolombo.com.br", "Formulário recebido",$corpo);
									mail("ladyty_lu@hotmail.com", "Formulário recebido",$corpo);
									// agradeço o envio
									echo "Obrigado por preencehr o Formulário. Foi bem sucedidoo envio";
								}
							
							?>
			</div>
					<!-- inicio dos campos ao lado do formulario -->
			<div id="contatodireita">
				<div class="branco" style="width:400px; float:left;  background-color:#444444; margin-left:20px; margin-right:20px; display:inline; padding-right:10px;">
				<h2>Colombo Comunicação Visual Ltda.</h2> <br />
				Av. Nossa Senhora de Fátima, 157<br />
				CEP: 85902-230 | Jd. Porto Alegre<br />
				Toledo - PR<br /><br /><br />
				
				<h2>Atendimento:</h2><br />
				45 3378-1012<br />
				45 3278-5754<br />
				gcolombo@brturbo.com.br<br /><br />
				</div>
						
				<div id="soliciteorcamento" style="float:right; margin-top:15px; margin-right:20px;">
							<br>
							Solicite um Orcamento<br><br>
							<a href="orcamento.php" class="sublinhado">Clique aqui</a>
				</div>
						
						
			</div>
					<!-- fim dos campos ao lado do formulario -->
			<div class="titulocontato">
			  <h1>:: Localização</h1>
			</div>
					<!-- parte abaixo do formulario -->
			<div class="branco" style="width:1100px; height:339px;">
			  <div id="mapa"> 
				<!-- mapa do google -->
				<iframe width="448" height="286" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=nossa+senhora+de+fatima,+157,+toledo&amp;aq=&amp;sll=-24.724782,-53.727173&amp;sspn=0.001944,0.004128&amp;ie=UTF8&amp;hq=&amp;hnear=Av.+Ns.+de+F%C3%A1tima,+157+-+Jardim+Porto+Alegre,+Toledo+-+Paran%C3%A1,+85906-230&amp;t=m&amp;z=14&amp;ll=-24.724206,-53.727478&amp;output=embed"></iframe>
			  </div>
			 
			</div>
					<!-- fim da parte abaixo do formulario -->
		</div>
				  <!-- aqui termina o conteudo da pagina inicial --> 
				  <!-- div que gera a sombra do fundo da pagina -->
	    <div class="branco" style="width:24px; height:910px; overflow:hidden;">
			<div class="branco" style="width:24px; height:433px; overflow:hidden; background-image:url(imagens/right.jpg); background-repeat:no-repeat;"></div>
	    </div>
				</div>
				</body>
				</html><?php include("footer.php"); ?>