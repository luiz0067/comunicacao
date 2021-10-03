<?php include("conecta.php"); ?>
<?php

	$depoimento_codigo="";
	$depoimento_titulo="";
	$depoimento_id_empresa="";
	$depoimento_imagem="";
	$nome="";
	$imagem="";
	
	$row="";
	$sql="";
	$linha=null;
	$result=null;
	if(isset($_GET["codigo"])){
		$codigo=$_GET["codigo"];
		$sql="select depoimento.codigo,depoimento.titulo, depoimento.descricao, depoimento.empresa as id_empresa from depoimento where (depoimento.empresa='1') and (depoimento.codigo=0".$codigo.") order by depoimento.codigo desc limit 0,1;";
		$result=mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);
		$depoimento_codigo		=$row['codigo'];
		$depoimento_titulo		=$row['titulo'];
		$depoimento_id_empresa	=$row['id_empresa'];
		$depoimento_imagem		=$row['imagem'];
	}
	else{
		$sql					="select depoimento.codigo,depoimento.titulo, depoimento.imagem, depoimento.empresa as id_empresa from depoimento where (depoimento.empresa='1') order by depoimento.codigo desc limit 0,1;";
		$result					=mysql_query($sql, $link);
		$row					=mysql_fetch_assoc($result);
		$depoimento_codigo		=$row['codigo'];
		$depoimento_titulo		=$row['titulo'];
		$depoimento_id_empresa	=$row['id_empresa'];
		$depoimento_imagem		=$row['imagem'];
	}
	$cat=$codigo;
?>
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
			<!-- aqui comeca o conteudo da pagina inicial -->
			<div class="contentprincipal">
				<div id="containerdepoimento">
					<div class="titulocontainerdepoimento"><h1>:: Depoimento</h1></div>
				<?php	if($result!=null){
					mysql_free_result($result);
				}
				$sql = "select depoimento.codigo,depoimento.titulo, depoimento.imagem, depoimento.empresa as id_empresa from depoimento where (depoimento.empresa='1') and (depoimento.codigo=0".$depoimento_codigo.")";
				$result = mysql_query($sql,$link);
				if (!$result){
					echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
					echo 'Erro MySQL: ' . mysql_error();
					exit;
				}
				while ($row = mysql_fetch_assoc($result)){
					$i=0;
					$titulo=$row ["titulo"];
					$imagem=$row ["imagem"];
				?>
					<div class="fotodepoimento"><img src="./upload/imagens/depoimento/g_<?php echo $imagem; ?>" width="254" height="189" border="0" /></div>
					<div class="escritadepoimento"><?php echo $titulo; ?></div>
					<?php 
					}
					
				?>
				</div>
				<div class="voltardepoimento"><a href="depoimentoslista.php" style="text-decoration:none;" target="_self"><h1>:: Voltar</h1></a></div>
				<div class="galeriadepoimentos">
					<div class="titulogaleriadepoimentos"><h1>:: Galeria de Fotos</h1></div>
					<div class="linhafotos" id="gallery">
<?php 
				if($result!=null){
					mysql_free_result($result);
				}
				$sql = "select f.depoimento as codigo_depoimento, f.nome, f.imagem, f.link, f.empresa as id_empresa from fotos_depoimento f where (f.empresa='1') and (f.depoimento=0".$depoimento_codigo.")";
				
				$result = mysql_query($sql,$link);
				if (!$result){
					echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
					echo 'Erro MySQL: ' . mysql_error();
					exit;
				}
				while ($row = mysql_fetch_assoc($result)){
						$i=0;
					$depoimento_titulo=$row ["nome"];
					$depoimento_imagem=$row ["imagem"];
				?>
						<div class="fotogaleriadepoimento">
							<a href="./upload/imagens/depoimento/fotos_depoimento/h_<?php echo $depoimento_imagem; ?>" rel="lightbox" title="<?php echo $depoimento_nome; ?>">
								<img src="./upload/imagens/depoimento/fotos_depoimento/h_<?php echo $depoimento_imagem; ?>" width="94" height="84" border="0"/>
							</a>
						</div>
						<div class="divisordepoimento"></div>
				<?php 
					if($i%9==8){
				?>
					</div>	
					<div class="linhafotos">
				<?php 
					}
					$i++;
				}
				?>
					</div>
					<div class="divisordepoimento"></div>
				</div>
			</div>
			<div class="branco" style="width:851px; height:25px;"></div>
			<div class="branco">
				<div id="cartoesinicial">
					<div class="linhascartoes" style="margin-top:60px; display:inline;">
						<div id="flashcartaoinicial"><img src="imagens/flashcartao.jpg" width="259" height="125" border="0" /></div>
						<div id="soliciteorcamento">
							<br>
							Solicite um Orcamento<br><br>
							<a href="orcamento.php" target="_self" style="text-decoration:none; color:#FFF;">Clique aqui</a>
						</div>
					</div>
				</div>
			</div>
			<div class="branco">
				<div id="medalha20anosprojeto"><img src="imagens/medalha.jpg" width="290" height="201" border="0" /></div>
			</div>
		</div>
		<!-- aqui termina o conteudo da pagina inicial --> 
		<!-- div que gera a sombra do fundo da pagina -->
		<div class="branco" style="width:24px; overflow:hidden;">
			<div class="branco" style="width:24px; height:433px; overflow:hidden; background-image:url(imagens/right.jpg); background-repeat:no-repeat;"></div>
		</div>
		
<?php include("footer.php"); ?>