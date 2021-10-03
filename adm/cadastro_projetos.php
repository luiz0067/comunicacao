<?php
	include('cabecalho.php');
	$row=null;
	$result=null;
	if (($_GET["codigo"]!=null)){
		$sql = "SELECT * FROM projetos  where (projetos.empresa=".$_SESSION["empresa"].") and (codigo=".$_GET["codigo"].");";
		$result=mysql_query($sql,$link);
		$row = mysql_fetch_assoc($result);	
	}
	$categoria=0;
	if (isset($_GET["categoria"])){
		$categoria=$_GET["categoria"];	
	}
	else if (isset($_POST["categoria"])){
		$categoria=$_POST["categoria"];
	}
	
?>
<head>
	<script type="text/javascript" src="./js/functions.js"></script>
</head>
<center>
<form method="post" action="?codigo=<?php echo $_GET["codigo"]?>">
	<?PHP
		
	?>
	<table border="1">
		<tr>
		    <td>categoria:</td>
			<td>
				<select name="categoria" style="width:200px;" onchange="menuJump(this)">
					<?php
						$row_categoria=null;
						$result_categoria=null;					
						$sql_categoria="SELECT categoria.* FROM categoria where (categoria.empresa=".$_SESSION["empresa"].") order by nome asc";
						$result_categoria=mysql_query($sql_categoria, $link);
						while ($row_categoria = mysql_fetch_assoc($result_categoria)) {		
							if (($row["categoria"]==$row_categoria["codigo"])||($categoria==$row_categoria["codigo"])){
								$selected="SELECTED";
							}
							else
								$selected="";
					?>
					<option <?php echo $selected?> value="<?php if ($result_categoria!=null)  echo $row_categoria["codigo"]?>"><?php if ($result_categoria!=null)  echo $row_categoria["nome"]?></option>
					<?php
						}
						mysql_free_result($result_categoria);
					?>
				</select>
			</td>
															
		</tr>
		<tr>
			<td>id:</td>
			<td><input type="text" name="codigo" value="<?php if ($result!=null) echo $row["codigo"]?>"></td>
		</tr>
		<tr>
			<td>nome:</td>
			<td><input type="text" name="nome" value="<?php if ($result!=null)  echo $row["nome"]?>"></td>
		</tr>
        
		<tr>	
			<td>descricão:</td>
			<td><textarea name="descricao"><?php if ($result!=null)  echo $row["descricao"]?></textarea>	</td>
        </tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="acao" value="inserir">
				<input type="submit" name="acao" value="alterar">
				<input type="submit" name="acao" value="excluir">	
				<a target="_blank" href="./cadastro_foto.php?projetos=<?php if($result!=null)echo $row["codigo"]?>"><input type="button"  value="Inserir Fotos"></a>
				<input type="button"  value="limpar" onclick="self.location.href='?id='">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="buscar" value="buscar por nome">
				<input type="submit" name="buscar" value="buscar por codigo">
			</td>
		</tr>
	</table>
</form>		
<?php			
			if( $_POST['acao']=='excluir'){				
				$sql    = "delete  FROM projetos  where (projetos.empresa=".$_SESSION["empresa"].") and (codigo=".$_POST["codigo"].")";
				mysql_query($sql, $link);				
			}
			else if($_POST['acao']=='alterar'){
				$sql    = "update projetos set nome='".$_POST["nome"]."',categoria=".$_POST["categoria"].",descricao='".$_POST["descricao"]."'  where (projetos.empresa=".$_SESSION["empresa"].") and (codigo=".$_POST["codigo"].");";
				mysql_query($sql, $link);							
			}
			else if($_POST['acao']=='inserir'){
				$sql = "insert into projetos(nome,categoria,descricao,projetos.empresa) values ('".$_POST["nome"]."',".$_POST["categoria"].",'".$_POST["descricao"]."',".$_SESSION["empresa"].");";
				mysql_query($sql, $link);
			}
			if( $_POST['buscar']=='buscar por codigo'){
				$sql = "SELECT projetos.codigo,projetos.nome,categoria.nome as categoria,projetos.empresa,projetos.descricao FROM projetos left join categoria on(categoria.codigo=projetos.categoria)  where (projetos.empresa=".$_SESSION["empresa"].") and (projetos.codigo = 0".$_POST["codigo"].") and (categoria.codigo = 0".$categoria.")  order by projetos.nome asc";
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if( $_POST['buscar']=='buscar por nome'){
				$sql = " SELECT projetos.codigo,projetos.nome,categoria.nome as categoria,projetos.empresa,projetos.descricao FROM projetos left join categoria on(categoria.codigo=projetos.categoria)  where (projetos.empresa=".$_SESSION["empresa"].") and (projetos.nome like '%".$_POST["nome"]."%') and (categoria.codigo = 0".$categoria.") order by projetos.nome asc";
				mysql_query($sql, $link);
			}
			else 
				$sql    = "SELECT projetos.codigo,projetos.nome,categoria.nome as categoria,projetos.empresa,projetos.descricao FROM projetos left join categoria on(categoria.codigo=projetos.categoria) where (projetos.empresa=".$_SESSION["empresa"].") and (categoria.codigo = 0".$categoria.") order by projetos.nome asc";
			$result = mysql_query($sql, $link);
			if(($_POST["total"]=="")&&($result!=null))
				$total=mySQL_num_rows($result);
			else
				$total=$_POST["total"];				
			if($_POST["mover"]=="primeiro"){
				$limite=" limit 0 , ".$_POST["registros"];
				$pagina=1;
			}
			else if($_POST["mover"]=="ultimo"){
				//$limite=" limit ".(($_POST["total"]%$_POST["registros"])*$_POST["registros"])." , ".$_POST["total"];
				$pagina=($_POST["total"]-($_POST["total"]%$_POST["registros"]))/$_POST["registros"];
				$limite=" limit ".($pagina*$_POST["registros"])." , ".$_POST["registros"];
				$pagina++;
			}
			else if($_POST["mover"]=="proximo"){
				if ((($_POST["pagina"]+1)*$_POST["registros"])>$_POST["total"]){
					//$limite=" limit ".(($_POST["total"]%$_POST["registros"])*$_POST["registros"])." , ".$_POST["total"];
					$pagina=($_POST["total"]-($_POST["total"]%$_POST["registros"]))/$_POST["registros"];
					$limite=" limit ".($pagina*$_POST["registros"])." , ".$_POST["registros"];
					$pagina++;
				}
				else{
					//$limite=" limit ".(($_POST["pagina"])*$_POST["registros"])." , ".(($_POST["pagina"]+1)*$_POST["registros"]);
					$limite=" limit ".(($_POST["pagina"])*$_POST["registros"])." , ".$_POST["registros"];
					$pagina=$_POST["pagina"]+1;
				}
			}
			else if($_POST["mover"]=="anterior"){
				if((($_POST["pagina"]-2)*$_POST["registros"])<0){
					$limite=" limit 0 , ".$_POST["registros"];
					$pagina=1;
				}
				else{
					//$limite=" limit ".(($_POST["pagina"]-2)*$_POST["registros"])." , ".(($_POST["pagina"]-1)*$_POST["registros"]);
					$limite=" limit ".(($_POST["pagina"]-2)*$_POST["registros"])." , ".$_POST["registros"];
					$pagina=$_POST["pagina"]-1;
				}
			}
			else if($_POST["mover"]=="ok"){
				//$limite=" limit ".(($_POST["pagina"]-1)*$_POST["registros"])." , ".(($_POST["pagina"])*$_POST["registros"]);
				$limite=" limit ".(($_POST["pagina"]-1)*$_POST["registros"])." , ".$_POST["registros"];
				$pagina=$_POST["pagina"];
			}
			else{
				$limite=" limit 0 , 10";
				$pagina=1;
			}
			$sql=$sql.$limite.";";
		?>
		<form method="post">
			<input type="hidden" name="codigo" value="<?php echo $_POST["codigo"];?>">
			<input type="hidden" name="nome" value="<?php echo $_POST["nome"];?>">
			<input type="hidden" name="categoria" value="<?php echo $_POST["nome"];?>">
			<input type="hidden" name="buscar" value="<?php echo $_POST["buscar"];?>">
			<input type="hidden" name="total" value="<?php echo $total?>">
			<table border="0px" cellpadding="0" cellspacing="0">
				<tr>
					<td>pagina:<input type="text" name="pagina" value="<?php echo $pagina;?>" size="3"></td>
					<td>
						<select name="registros">
							<option value="10" <?php if(($_POST["registros"]=="10")||($_POST["registros"]=="")) echo "selected";?> selected>10</option>
							<option value="20" <?php if($_POST["registros"]=="20") echo "selected";?> >20</option>
							<option value="30" <?php if($_POST["registros"]=="30") echo "selected";?> >30</option>
							<option value="40" <?php if($_POST["registros"]=="40") echo "selected";?> >40</option>
							<option value="50" <?php if($_POST["registros"]=="50") echo "selected";?> >50</option>
						</select>
					</td>
					<td><input type="submit" name="mover" value="ok"></td>
				</tr>
			</table>
			Total de projetos encontrados : <?php echo $total;?>
			<table border="0px" cellpadding="0" cellspacing="0">
				<tr>
					<td><input type="submit" name="mover" value="primeiro"></td>
					<td><input type="submit" name="mover" value="anterior"></td>
					<td><input type="submit" name="mover" value="proximo"></td>
					<td><input type="submit" name="mover" value="ultimo"></td>
				</tr>
			</table>
		</form>
	<table border="1">
		<tr>
			<td>codigo</td>
			<td>nome</td>
			<td>categoria</td> 
            <td>descricão</td> 
		</tr>
		<?php			
			/*if( $_POST['acao']=='buscar')*/
			if ($result!=null){
				mysql_free_result($result);
			}		
			$result = mysql_query($sql, $link);
			if (!$result) {
				echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			while ($row = mysql_fetch_assoc($result)) {
		?> 
				<tr>
					<td><a href="?codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?></a></td>
					<td><?php echo $row['nome'];?>&nbsp </td>
					<td><?php echo $row['categoria'];?>&nbsp </td>
                    <td><?php echo $row['descricao'];?>&nbsp </td>
				</tr>
		<?php 				
			}
		?>
		</table>	
</center>	
<?php	
	include('rodape.php');
?>