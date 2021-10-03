<?php	
include('cabecalho.php');
	$row=null;
	$result=null;
	if (($_GET["codigo"]!=null)){
		$sql	= "SELECT codigo,nome,empresa FROM categoria  where (empresa=".$_SESSION["empresa"].") and(codigo=0".$_GET["codigo"].")";
		$result=mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);
	}
?>
<center>
	<form method="post">
		<table border="1">
			<tr>
				<td>codigo:</td>
				<td><input type="text" name="codigo" value="<?php if ($result!=null) echo $row["codigo"]?>"></td>
			</tr>
			<tr>
				<td>categoria:</td>
				<td><input type="text" name="nome" value="<?php if ($result!=null) echo $row["categoria"]?>"></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="acao" value="inserir">
					<input type="submit" name="acao" value="alterar">
					<input type="submit" name="acao" value="excluir">
					<input type="button" value="limpar" onclick="self.location.href='?codigo'">
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
				
				if ($_POST['acao']=='excluir'){
					$sql = "delete FROM categoria  where (empresa=".$_SESSION["empresa"].") and (codigo=".$_POST["codigo"].")";
					//echo $sql;
					mysql_query($sql, $link);
				}
				else if ($_POST ['acao']=='alterar'){
					$sql = "update categoria set nome='".$_POST["nome"]."',empresa=".$_SESSION["empresa"]."  where (empresa=".$_SESSION["empresa"].") and(codigo=".$_POST["codigo"].");";
					//echo $sql;
					mysql_query($sql, $link);
				}
				else if( $_POST['acao']=='inserir'){
					$sql = "insert into categoria (nome,empresa) values ('".$_POST["nome"]."',".$_SESSION["empresa"].");";
					//echo $sql;
					mysql_query($sql, $link);
				}
				
				if( $_POST['buscar']=='buscar por codigo'){
					$sql    = "select codigo,nome,empresa FROM categoria  where (empresa=".$_SESSION["empresa"].") and(codigo=".$_POST["codigo"].") and (empresa=".$_SESSION["empresa"].") order by codigo asc";
					//echo $sql;
					mysql_query($sql, $link);
				}
				else if( $_POST['buscar']=='buscar por nome'){
					$sql    = "select codigo,nome,empresa FROM categoria  where (empresa=".$_SESSION["empresa"].") and(nome like '%".$_POST["nome"]."%') and (empresa=".$_SESSION["empresa"].")  order by nome asc";
					//echo $sql;
					mysql_query($sql, $link);
				}
				else 
					$sql    = "SELECT codigo,nome,empresa FROM categoria where (empresa=".$_SESSION["empresa"].") order by nome asc";
				$result = mysql_query($sql, $link);
				if($_POST["total"]=="")
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
			Total de categorias encontradas : <?php echo $total;?>
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
				<td>categoria</td>
			</tr>
		<?php
			$result = mysql_query($sql, $link);
			if ($result!=null)
			while ($row = mysql_fetch_assoc($result)){
		?>
				<tr>
					<td><a href="?codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?><a/></td>
					<td><?php echo $row['nome'];?>&nbsp </td>       
				</tr>
		<?php
			}
			if ($result!=null){
				mysql_free_result($result);
			}
		?>
		</table>
	</center>
<?php
	include('rodape.php');
?>
