<?php include('conecta.php');?>
<div class="degradefundo"></div>
<div class="content"> 
  <!-- div que gera a sombra do fundo da pagina -->
	<div class="branco" style="width:25px; height:872px; overflow:hidden;">
		<div class="branco" style="width:25px; height:433px; overflow:hidden; background-image:url(imagens/left.jpg); background-repeat:no-repeat;"></div>
	</div>
  <!-- aqui comeca o conteudo da pagina inicial -->
	<div class="contentprincipal">
		<div id="flashinicio">
	
			<iframe name="slideshow" width="1050" height="330" frameborder="0" marginwidth="" hspace="0" vspace="0" scrolling="no" src="slide/demo/slide.php" style="margin-left:20px;"></iframe>
	
		</div>
	
		<div id="colunaesquerdainicial">
			<div id="noticiasrecentes">
				<div class="nomecategoria">
				<div class="nomecategoria"><h1>:: Projetos Recentes</h1></div>
				</div>
				<!-- primeira noticia recente -->
				<?php
				$sql = "SELECT projetos.codigo,projetos.descricao,(SELECT f2.imagem FROM fotos f2 where((SELECT max(f1.codigo) FROM fotos f1 where (f1.projetos=projetos.codigo))=f2.codigo))as imagem FROM projetos where (projetos.empresa='1') order by projetos.codigo desc limit 0,2;";
				
				$result = mysql_query($sql, $link);
				while ($row = mysql_fetch_assoc($result)){				
					$descricao=$row["descricao"];
					$descricao=substr($descricao, 0, 50);
					$result_fotos = mysql_query($sql_fotos, $link);
					
						$imagem=$row["imagem"];
				?> 
				<div class="linhasnoticiasrecentes">
					<div class="noticiasrecentes">
						<div class="fotonoticiasrecentes"><img src= "./upload/imagens/projetos/fotos_projetos/m_<?php echo $imagem; ?> "width="133" height="96" border="0" /></div>
						<div class="descricaonoticiasrecentes"><a href="projetos.php?codigo=<?php echo $row ["codigo"];?>" class="sublinhado"><?php echo $descricao; ?> ...</a> </div>
					</div>
					
				</div>
				
				<div class="divisornoticiasrecentes"></div>
				
			
				<?php }
						$i++;
					
				?>
				
				<!-- fim da segunda noticia recente -->
			</div>
			<div class="divisorcategoriaesquerda"></div>
			<div id="novidades">
				
				<div class="nomecategoria">
					<div style="float:left"><h1>:: Novidades </h1></div>
					<div style="float:right"><a href="novidadeslista.php" target="_self" style="text-decoration:none; color:#FFF;"><h1 style="float:right">Mais...</h1></a></div>
				</div>
				<!-- primeira linha de novidade -->
				<?php 
								
								$sql = "select n.codigo, n.nome from novidades n where (n.empresa='1') order by n.codigo desc limit 0,2;";
								$result = mysql_query($sql, $link);
								if (!$result){
									echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
									echo 'Erro MySQL: '. mysql_error();
									exit;
								}
								while ($row = mysql_fetch_assoc($result)){
									$i=0;
									$nome=$row ["nome"];
									$nome=substr($nome, 0, 100);
								?>
				<div class="linhasnovidades">
					<div class="novidades"><a href="novidades.php?codigo=<?php echo $row ["codigo"];?>" class="sublinhado"><?php echo $nome;  ?>...</a> </div>
				
				</div>
				<div class="divisornovidades"></div>
				
				<?php }
						$i++;
					
				?>
			</div>
			<!-- fim das novidades -->
			<div class="divisorcategoriaesquerda"></div>
			<div id="cartoesinicial">
				<div class="linhascartoes">
					<div id="flashcartaoinicial"><img src="imagens/flashcartao.jpg" width="259" height="125" border="0" /></div>
					<div id="soliciteorcamento">
						<br>
						Solicite um Orcamento<br><br>
						<a href="orcamento.php" class="sublinhado">Clique aqui</a>
					</div>
				</div>
			</div>
		</div>
		<!-- comeco da coluna da direita -->
		<div id="colunadireitainicial">
<?php						
								$sql = "select d.codigo, d.titulo from depoimento d where (d.empresa='1') order by d.codigo desc limit 0,1;";
								$result = mysql_query($sql, $link);
								if (!$result){
									echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
									echo 'Erro MySQL: '. mysql_error();
									exit;
								}
								while ($row = mysql_fetch_assoc($result)){
									$i=0;
									$codigo=$row ["codigo"];
									$titulo=$row ["titulo"];
									$titulo=substr($titulo,0,40);
?>
			<div id="depoimentosinicial">
			
				<div class="nomedepoimentosinicial"><h1>:: Depoimentos </h1></div>
				<div id="escritadepoimento"><a href="depoimentos.php?codigo=<?php echo $codigo;?>" target="_self" class="sublinhado" style="font-size:26px;"><?php echo $titulo;  ?>...</a></div>
					
				<div id="confiradepoimento"><a href="depoimentoslista.php" class="escritalerdepoimentos">Confira todos os depoimentos</a></div>
			</div>
			<div id="medalha20anos"><img src="imagens/medalha.jpg" width="290" height="201" border="0" /></div>
						<?php 	} ?>
		</div>
	</div>
	<!-- aqui termina o conteudo da pagina inicial --> 
	<!-- div que gera a sombra do fundo da pagina -->
	<div class="branco" style="width:24px; height:872px; overflow:hidden;">
		<div class="branco" style="width:24px; height:433px; overflow:hidden; background-image:url(imagens/right.jpg); background-repeat:no-repeat;"></div>
	</div>
</div>