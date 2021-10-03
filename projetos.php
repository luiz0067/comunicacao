<?php include("conecta.php"); ?>
<?php 

	$pg = $_GET["pg"];
	$registros_pagina=4;
	if(!is_numeric($pg)){
		$pg=1;
	}
	
	$imagem ="";
	$descricao="";
	$nome="";
	$catnome="";
	$cat="";
			
	$sql="";//consulta select
	$linha=null;//registro da consulta
	$row="";//mesma coisa depende do meu estado de humor
	$result=null;//todos os resultados
		if(isset($_GET["codigo"])){//verrifica se o parametro esta vazio se nao preenche com ""
			$codigo=$_GET['codigo'];
			$sql = "select * from categoria where(codigo=".$codigo.") and (categoria.empresa='1') ";
			$result=mysql_query($sql, $link);//realiza a consulta
			$row = mysql_fetch_assoc($result);//resgata a linha da consulta
			$cat=$row ['codigo'];//resgata o codigo de categoria
			$catnome=$row['nome'];//resgata o nome de categoria
		}
		else{//verrifica se o parametro esta vazio se nao preenche com ""
			$codigo="";
			$sql = "select * from categoria where (categoria.empresa='1')";
			$result=mysql_query($sql, $link);//realiza a consulta
			$row = mysql_fetch_assoc($result);//resgata a linha da consulta
			$cat=$row ['codigo'];//resgata o codigo de categoria
			$catnome=$row['nome'];//resgata o nome de categoria
		}
		//aqui ele buscou a categoria presente e se não encontrou busca a primeira.		
			$projetos_codigo=0;
			$sql = "select projetos.codigo, projetos.nome, projetos.descricao, projetos.categoria as codigo_categoria, categoria.nome as categoria_nome from projetos left join categoria on(projetos.categoria=categoria.codigo) where (projetos.categoria=0".$cat.") and (projetos.empresa='1')  order by nome asc;";
			$result = mysql_query($sql,$link);
			if (($result!=null)&&(true)){
				$row=mysql_fetch_assoc($result);
				$projetos_codigo=$row ['codigo'];
				$projetos_nome=$row ['nome'];
				$descricao=$row ['descricao'];
				$codigo_categoria=$row ['codigo_categoria'];
				$categoria_nome=$row ['categoria_nome'];
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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

			<link rel="stylesheet" type="text/css" href="../style-projects-jquery.css" />    
			<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
			<style type="text/css">
			/* jQuery lightBox plugin - Gallery style */
			#gallery {
			}
			#gallery ul { list-style: none; }
			#gallery ul li { display: inline; }
			#gallery ul img {
			}
			#gallery ul a:hover img {
			}
			#gallery ul a:hover { color: #fff; }
			</style>
			<script type="text/javascript" src="js/jquery.js"></script>
			<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
			<script type="text/javascript">
			$(function() {
				$('#gallery a').lightBox();
			});					
			$(function() {
				$('#gallery a').lightBox();
			});
			
		</script>

	</head>
	<?php include("header.php"); ?>
	<body>
		<div class="degradefundo"></div>
		<div class="content">
				<!-- div que gera a sombra do fundo da pagina -->
			<div class="branco" style="width:25px; height:872px; overflow:hidden;">
				<div class="branco" style="width:25px; height:433px; overflow:hidden; background-image:url(imagens/left.jpg); background-repeat:no-repeat;"></div>
			</div>
				<!-- aqui comeca o conteudo -->
			<div class="contentprincipal">
				<div id="tituloprojeto"><h1>::Projetos realizados</h1></div>
				<div id="partecima">
					<?php include("menuprojetos.php"); ?>
					<div id="colunadireitaprojeto">
						<div class="branco" style="width:829px; height:auto;">
							<div class="titulocolunadireitaprojeto">
							  <h1>:: <?php echo $projetos_nome;?></h1>
							</div>
						<div class="descricacategoriaprojeto"><?php echo $descricao;?> </div>
						
						<div class="divisorprojetos"></div>
						<!-- primeira linha de projetos -->
						<div class="linhasprojetos" id="gallery">
<?php 											
												$registros_pagina=15;
												if ($result!=null){
													mysql_free_result($result);
												}
												$sql = "SELECT * FROM fotos where(fotos.projetos=0".$projetos_codigo.") order by codigo desc limit ".(($pg-1)*$registros_pagina).",".$registros_pagina;						
												//echo $sql;
												$result = mysql_query($sql, $link);
												if (!$result){
													echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
													echo 'Erro MySQL: '. mysql_error();
													exit;
												}
												$i=0;
												while ($row = mysql_fetch_assoc($result)){														
													$nome=$row ["nome"];
													$descricao=$row ["descricao"];
													$imagem=$row ["imagem"];
?>												<a href="./upload/imagens/projetos/fotos_projetos/h_<?php echo $row['imagem'];?>" title="<?php echo $nome;?>" rel="lightbox">
													<div class="divisorprojeto"></div>
													<div class="projeto">
														<div class="fotoprojeto"><img src="./upload/imagens/projetos/fotos_projetos/g_<?php echo $row['imagem'];?>" width="120" height="88" border="0" /></div>
														<div class="descricaoprojeto">
															<h3><?php echo $nome;?></h3>
														</div>
													</div>
												</a>
													<?php if(($i%5==4)&&($i!=14)){?>
						</div>
						<div class="linhasprojetos">
													<?php }?>
<?php 
													$i++;
												}
?>
						</div>
					<!--fim da terceira linha de projetos -->
							<div class="paginacaodepoimentos">
							<?php 
								$sql								= " select count(fotos.codigo)as total FROM fotos where(fotos.projetos=0".$projetos_codigo.")and(fotos.empresa='1') ";
								$result 							= mysql_query($sql,$link);
								$row 								= mysql_fetch_assoc($result);
								$total_registros					= $row["total"];
								$total=floor($total_registros/$registros_pagina);
								if(($total%$registros_pagina)!=0){
									$total++;
								}
							?>
							<?php if($pg>1){ 									?><a class="numerospaginacao" href="?pg=1&codigo=<?php echo $codigo_categoria;?>"							> << 					</a><?php }?>
							<?php if($pg>1){	 								?><a class="numerospaginacao" href="?pg=<?php echo ($pg-1);?>&codigo=<?php echo $codigo_categoria;?>"		> < 					</a><?php }?>
							<?php if($pg<=($total)){ 							?><a class="numerospaginacao" href="?pg=<?php echo ($pg+0);?>&codigo=<?php echo $codigo_categoria;?>"		><?php echo $pg;?>		</a><?php }?>
							<?php if((($pg+1)<=($total))&&($pg>=1)){			?><a class="numerospaginacao" href="?pg=<?php echo ($pg+1);?>&codigo=<?php echo $codigo_categoria;?>"		><?php echo ($pg+1);?>	</a><?php }?>
							<?php if((($pg+2)<=($total))&&($pg>=1)){  			?><a class="numerospaginacao" href="?pg=<?php echo ($pg+2);?>&codigo=<?php echo $codigo_categoria;?>"		><?php echo ($pg+2);?>	</a><?php }?>
							<?php if((($pg+1)<=($total))&&($pg>=1)){			?><a class="numerospaginacao" href="?pg=<?php echo ($total-1);?>&codigo=<?php echo $codigo_categoria;?>"	> > 					</a><?php }?>
							<?php if((($pg+1)<=($total))&&($pg>=1)){  			?><a class="numerospaginacao" href="?pg=<?php echo ($total);?>&codigo=<?php echo $codigo_categoria;?>"		> >> 					</a><?php }?>
							
						    </div>
							<div id="lerdepoimentos"><a href="depoimentoslista.php" class="sublinhado" target="iframeprojetos">:: Leia o depoimento de nossos clientes</a></div>
						</div>
					</div>
				</div>
				<div id="partebaixo">
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
				</div>
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