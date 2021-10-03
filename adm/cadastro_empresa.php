<?php	
	include('cabecalho.php');
	$row=null;
	$result=null;
	if (($_GET["id"]!=null)){
		$sql	= "SELECT id,empresa FROM empresa  where (empresa=".$_SESSION["empresa"].") and(id=0".$_GET["id"].")";
		$result=mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);
	}
?>
<center>
	<form method="post">
		<table border="1">
		<tr>
			<td>ID:</td>
			<td><input type="text" name="id" value="<?php if ($result!=null) echo $row["id"]?>"></td>
		</tr>
		<tr>
			<td>empresa:</td>
			<td><input type="text" name="empresa" value="<?php if ($result!=null) echo $row["empresa"]?>"></td>
		</tr>
		
		<tr>
			<td colspan="2">
				<input type="submit" name="acao" value="inserir">
				<input type="submit" name="acao" value="alterar">
				<input type="submit" name="acao" value="excluir">
				<input type="button" value="limpar" onclick="self.location.href='?id'">
			</td>
		</tr>
	</table>
</form>
		<?php
			
			if ($_POST['acao']=='excluir'){
				$sql = 'delete FROM empresa  where (empresa=".$_SESSION["empresa"].") andid='.$_POST["id"];
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if ($_POST ['acao']=='alterar'){
				$sql = "update empresa set empresa='".$_POST["empresa"]."'  where (empresa=".$_SESSION["empresa"].") and(id=".$_POST["id"].");";
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if( $_POST['acao']=='inserir'){
				$sql = "insert into empresa (empresa) values ('".$_POST["empresa"]."');";
				//echo $sql;
				mysql_query($sql, $link);
			}
				else if( $_POST['acao']=='inserir'){
				$sql    = "insert into empresa (empresa) values ('".$_POST["empresa"]."',);";
				//echo $sql;
				mysql_query($sql, $link);
			}			
		?>
		<table border="1">
			<tr>
				<td>id</td>
				<td>empresa</td>
				
			</tr>
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql    = 'SELECT id,empresa FROM empresa order by empresa asc;';
			$result = mysql_query($sql, $link);
			if (!$result) {
				echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			while ($row = mysql_fetch_assoc($result)){
		?>
				<tr>
					<td><a href="?id=<?php echo $row['id'];?>"><?php echo $row['id'];?><a/></td>
					<td><?php echo $row['empresa'];?>&nbsp </td>                
					
				</tr>
			<?php
				}
				mysql_free_result($result);
			?>
			</table>
		
<center>
<?php
	include('rodape.php');
?>
