<?php include("conecta.php"); ?>
<?php

	$novidades_codigo="";
	$novidades_nome="";
	$novidades_id_empresa="";
	$novidades_imagem="";
	$nome="";
	$imagem="";
	
	$row="";
	$sql="";
	$linha=null;
	$result=null;
	if(isset($_GET["codigo"])){
		$codigo=$_GET["codigo"];
		$sql="select novidades.codigo,novidades.nome,novidades.empresa as id_empresa,novidades.imagem  from novidades  where(novidades.empresa='1')and(novidades.codigo=0".$codigo.")order by novidades.codigo desc limit 0,1;";
		$result=mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);
		$novidades_codigo		=$row['codigo'];
		$novidades_nome			=$row['nome'];
		$novidades_id_empresa	=$row['id_empresa'];
		$novidades_imagem		=$row['imagem'];
	}
	else{
		$sql					="select novidades.codigo,novidades.nome,novidades.empresa as id_empresa,novidades.imagem  from novidades  where(novidades.empresa='1')order by novidades.codigo desc limit 0,1;";
		$result					=mysql_query($sql, $link);
		$row					=mysql_fetch_assoc($result);
		$novidades_codigo		=$row['codigo'];
		$novidades_nome			=$row['nome'];
		$novidades_id_empresa	=$row['id_empresa'];
		$novidades_imagem		=$row['imagem'];
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
					<div class="titulocontainerdepoimento"><h1>:: Novidade</h1></div>
				<?php	if($result!=null){
					mysql_free_result($result);
				}
				$sql = "SELECT n.codigo,n.nome,n.imagem,n.link,n.empresa FROM novidades n where(n.empresa='1')and(n.codigo=0".$novidades_codigo.")";
				$result = mysql_query($sql,$link);
				if (!$result){
					echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
					echo 'Erro MySQL: ' . mysql_error();
					exit;
				}
				while ($row = mysql_fetch_assoc($result)){
					$i=0;
					
					$nome=$row ["nome"];
					$imagem=$row ["imagem"];
					if ($imagem!=null){			
?>	
					<div class="fotodepoimento"><img src="./upload/imagens/novidades/g_<?php echo $imagem; ?>" width="254" height="189" border="0" /></div>
					<div class="escritadepoimento"><?php echo $nome; ?></div>
		<?php			}						
		else {
					?>
					
														
				<div class="escritadepoimento"><?php echo $nome; ?></div>
			
					
					<?php 
		}
	}							
?>
				</div>
				<div class="voltardepoimento"><a href="novidadeslista.php" style="text-decoration:none;" target="_self"><h1>:: Voltar</h1></a></div>
				<div class="galeriadepoimentos" id="gallery">
					<div class="titulogaleriadepoimentos"><h1>:: Galeria de Fotos</h1></div>
					<div class="linhafotos">
				<?php 
				
				if($result!=null){
					mysql_free_result($result);
				}
				$sql = "SELECT f.codigo,f.novidades,f.nome,f.imagem,f.link,f.empresa FROM fotos_novidades f where(f.novidades=".$novidades_codigo.")and (f.empresa='1')";
				$result = mysql_query($sql,$link);
				if (!$result){
					echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
					echo 'Erro MySQL: ' . mysql_error();
					exit;
				}
				while ($row = mysql_fetch_assoc($result)){
					$i=0;
					$novidades_nome=$row ["nome"];
					$novidades_imagem=$row ["imagem"];
				?>
						<div class="fotogaleriadepoimento">
							<a href="./upload/imagens/novidades/fotos_novidades/h_<?php echo $novidades_imagem; ?>" rel="lightbox" title="<?php echo $novidades_nome; ?>">
								<img src="./upload/imagens/novidades/fotos_novidades/h_<?php echo $novidades_imagem; ?>" width="94" height="84" border="0"/>
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