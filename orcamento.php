<?php include("conecta.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Grafica Colombo, Impressos graficos"/>
<meta name="classification" content="Studio Midia Mix : panfletos, folders, cartoes de visita, mala direta, livros, cartazes"/>
<meta name="keywords" content="Grafica Colombo, Colombo industria grafica, grafica de toledo, grafica em toledo, grafica colombo toledo, o.a. colombo,  "/>
<meta name="author" content="Studio Midia Mix - http://www.studiomidiamix.com.br"/>
<meta name="title" content="Grafica Colombo"/>
<meta name="resource-type" content="document"/>
<meta name="robots" content="all"/>
<meta name="language" content="pt-br"/>
<meta name="doc-class" content="completed"/>
<meta name="doc-rights" content="Public"/>
<meta name="geo.placename" content="Tol/edo, Parana, Brazil"/>
<meta name="geo.region" content="br-pr"/>
<title>Empresa</title>
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
<div class="contentorcamentofull"> 
  <!-- div que gera a sombra do fundo da pagina -->
  <div class="branco" style="width:25px; height:872px; overflow:hidden;">
    <div class="branco" style="width:25px; height:433px; overflow:hidden; background-image:url(imagens/left.jpg); background-repeat:no-repeat;"></div>
  </div>
  <!-- aqui comeca o conteudo da pagina inicial -->
  <div class="contentorcamento">
  	<div id="tituloorcamento"><h1>:: Orçamento</h1></div>
    <!-- inicio dos campos do orcamento -->
    <div class="orcamento">
   	  <form action="enviarorcamento.php" method="post" id="orcamentoform" style="height:auto; min-height:600px;">
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
						Nome *<br />
						<input class="inputorcamento" /><?php if (($nome="")&&($acao=="enviar")) {echo "Preencha o seu nome";$enviar=false;}?><br /><br />
						E-mail *<br />
						<input class="inputorcamento" />
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
						<br /><br />
				<?php 
					if (isset ($POST["telefone"]))
						$telefone=$POST['telefone'];
					else 
						$telefone="";
						
					if (isset ($POST["serviços"]))
						$serviços=$POST['serviços'];
					else
						$serviços="";
						
					if (isset ($POST["material"]))
						$material=$POST['material'];
					else
						$material="";
					
				?>
						 Telefone *<br />
						<input class="inputorcamento" /><?php if (($telefone="")&&($acao=="enviar")) {echo "Preencha o seu telefone";$enviar=false;}?><br /><br />
						
						Já sou cliente:<br />
						Sim<input name="sou_cliente" type="radio" value="sim" />
						Não<input name="sou_cliente" type="radio" value="sim" /><br /><br />
						
						Melhor Horário para contato:
						<select name="Horário">
						  <option>Manhã</option>
						  <option>Tarde</option>
						  <option>Noite</option>
						</select><br /><br />
						
						Departamento:
						<select name="Departamento">
						  <option selected="selected" Value="Financeiro">Financeiro</option>
						  <option>Orçamento</option>
						  <option>Vendas</option>
						  </select><br /><br />
						
						Descrição dos Serviços:<br />
						<textarea name="descricao" cols="60" class="inputorcamento2"><?php if (($serviços="")&&($acao=="enviar")) {echo "Preencha o seu serviços";$enviar=false;}?></textarea><br /><br />
						
						Dimensões e Material:<br />
						<textarea name="descricao" cols="60" class="inputorcamento2"><?php if (($material="")&&($acao=="enviar")) {echo "Preencha o seu material";$enviar=false;}?></textarea><br /><br />
						
						<input id="enviar" type="submit" value="Enviar" name="enviar"  />
						<input id="reset" type="reset" value="Limpar" name="limpar"  />
					
					</form>
					<?php if (($enviar )&&($acao=="enviar"))
					{
						$corpo = " Formulario de envio\n";
						$corpo = "Nome:" . $nome . "\n";
						$corpo = "Email:" . $email . "\n";
						$corpo = "Telefone:" . $telefone . "\n";
						$corpo = "serviços:" . $serviços . "\n";
						$corpo = "material:" . $material . "\n";
						//envio o correio...
						mail("contato@gcolombo.com.br", "Formulário recebido",$corpo);
						mail("ladyty_lu@hotmail.com", "Formulário recebido",$corpo);
						// agradeço o envio
						echo "Obrigado por preencehr o Formulário. Foi bem sucedido envio";
					}
					
				  ?>
				</div>
    <!-- lado do orcamento -->
    <div class="orcamentolado">
    	<img src="imagens/flashcartao.jpg" width="259" height="125" border="0" />
        <br /><br /><br /><br />
        <hr />
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <img src="imagens/logomapa.jpg" width="259" height="180" border="0" />
        
    </div>
    
  </div>
  <!-- aqui termina o conteudo da pagina inicial --> 
  <!-- div que gera a sombra do fundo da pagina -->
  <div class="branco" style="width:24px; height:872px; overflow:hidden;">
    <div class="branco" style="width:24px; height:433px; overflow:hidden; background-image:url(imagens/right.jpg); background-repeat:no-repeat;"></div>
  </div>
</div>
</body>
</html><?php include("footer.php"); ?>