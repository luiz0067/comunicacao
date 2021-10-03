<?php include("conecta.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>COLOMBO comunicacao visual</title>
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
<div class="content"> 
  <!-- div que gera a sombra do fundo da pagina -->
  <div class="branco" style="width:25px; height:872px; overflow:hidden;">
    <div class="branco" style="width:25px; height:433px; overflow:hidden; background-image:url(imagens/left.jpg); background-repeat:no-repeat;"></div>
  </div>
  <!-- aqui comeca o conteudo da pagina -->
  <div class="contentprincipal">
    <div class="titulodepoimentos"><h1>:: Depoimentos</h1></div>
<?php 
	$pg = $_GET["pg"];
	$registros_pagina=4;
	if(!is_numeric($pg)){
		$pg=1;
	}
	
	$registros_pagina=4;	
	
	$imagem ="";
	$codigo="";
	$titulo="";
	$row="";
	$sql="";
	$linha  = null;
	$result = null;
	
	if($result!=null){
		mysql_free_result($result);
	}
	$sql 	= "select d.codigo,d.titulo,d.empresa as id_empresa,d.imagem from depoimento d where(d.empresa='1')order by d.codigo desc limit ".(($pg-1)*$registros_pagina).",".$registros_pagina;
	$result = mysql_query($sql,$link);
	if (!$result){
		echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
		echo 'Erro MySQL: ' . mysql_error();
		exit;
	}
	while ($row = mysql_fetch_assoc($result)){
		$codigo=$row ["codigo"];
		$titulo=$row ["titulo"];
		$imagem=$row ["imagem"];
		if ($imagem!=null){			
?>	
			<div class="itensdepoimentos">
				<div class="fotoitensdepoimentos"><img src="./upload/imagens/depoimento/g_<?php echo $imagem; ?>" width="134" height="96" border="0" /></div>
				<div class="descricaoitensdepoimentos">
					<a class="sublinhado" href="depoimentos.php?codigo=<?php echo $codigo;?>" target="_self">
						<?php echo $titulo;?>
					</a>
				</div>
			</div>
<?php			
		}						
		else {				
?>							
			<div class="itensdepoimentos">										
				<div class="depoimentosemfoto">
					<a class="sublinhado" href="depoimentos.php?codigo=<?php echo $codigo;?>" target="_self">
						<?php echo $titulo;?>
					</a>
				</div>
			</div>
<?php 
		}
	}							
?>
    
   

    <!-- quarto depoimento-->

   <!-- div de paginacao--> 
   <div class="paginacaodepoimentos">
	<?php 
		$sql								= " select count(d.codigo)as total from depoimento d  where(d.empresa='1') order by d.codigo desc ";
		$result 							= mysql_query($sql,$link);
		$row 								= mysql_fetch_assoc($result);
		$total_registros					= $row["total"];
		$total=floor($total_registros/$registros_pagina);
		if(($total%$registros_pagina)!=0){
			$total++;
		}
	?>
   	<?php if($pg>1){ 									?><a class="numerospaginacao" href="?pg=1"							> << 					</a><?php }?>
    <?php if($pg>1){	 								?><a class="numerospaginacao" href="?pg=<?php echo ($pg-1);?>"		> < 					</a><?php }?>
    <?php if($pg<=($total)){ 							?><a class="numerospaginacao" href="?pg=<?php echo ($pg+0);?>"		><?php echo $pg;?>		</a><?php }?>
    <?php if((($pg+1)<=($total))&&($pg>=1)){			?><a class="numerospaginacao" href="?pg=<?php echo ($pg+1);?>"		><?php echo ($pg+1);?>	</a><?php }?>
    <?php if((($pg+2)<=($total))&&($pg>=1)){  			?><a class="numerospaginacao" href="?pg=<?php echo ($pg+2);?>"		><?php echo ($pg+2);?>	</a><?php }?>
    <?php if((($pg+1)<=($total))&&($pg>=1)){			?><a class="numerospaginacao" href="?pg=<?php echo ($total-1);?>"	> > 					</a><?php }?>
    <?php if((($pg+1)<=($total))&&($pg>=1)){  			?><a class="numerospaginacao" href="?pg=<?php echo ($total);?>"		> >> 					</a><?php }?>
	
   </div>
   <!-- fim dos depoimentos--> 
  	<!-- flash cartoes-->
    <div class="branco">
    <div id="cartoesinicial">
      <div class="linhascartoes" style="margin-top:60px; display:inline;">
        <div id="flashcartaoinicial"><img src="imagens/flashcartao.jpg" width="259" height="125" border="0" /></div>
        <div id="soliciteorcamento"><br>
          Solicite um Orcamento<br>
          <br>
          <a href="orcamento.php" target="_self" class="sublinhado">Clique aqui</a></div>
      </div>
    </div>
  </div>
  <div class="branco">
    <div id="medalha20anosprojeto"><img src="imagens/medalha.jpg" width="290" height="201" border="0" /></div>
  </div>
	<!--fim dos flash cartoes -->
  </div>
 
 
  <!-- aqui termina o conteudo da pagina inicial --> 
  <!-- div que gera a sombra do fundo da pagina -->
  <div class="branco" style="width:24px; height:872px; overflow:hidden;">
    <div class="branco" style="width:24px; height:433px; overflow:hidden; background-image:url(imagens/right.jpg); background-repeat:no-repeat;"></div>
  </div>
</div>
</body>
</html>
<?php include("footer.php"); ?>