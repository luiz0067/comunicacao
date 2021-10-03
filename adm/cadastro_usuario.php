<?php	
	include('cabecalho.php');
	$row=null;
	$result=null;
	if (($_GET["codigo"]!=null)){
		$sql	= "SELECT codigo,usuario,senha FROM usuario  where (empresa=".$_SESSION["empresa"].") and (codigo=0".$_GET["codigo"].")";
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
			<td>usuario:</td>
			<td><input type="text" name="usuario" value="<?php if ($result!=null) echo $row["usuario"]?>"></td>
		</tr>
		<tr>
			<td>senha:</td>
			<td><input type="text" name="senha" value="<?php if ($result!=null) echo $row["usuario"]?>"></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="acao" value="inserir">
				<input type="submit" name="acao" value="alterar">
				<input type="submit" name="acao" value="excluir">
				<input type="button" value="limpar" onclick="self.location.href='?codigo'">
			</td>
		</tr>
	</table>
</form>
<?php
			if ($_POST['acao']=='excluir'){
				$sql = 'delete FROM usuario  where (empresa=".$_SESSION["empresa"].") and codigo='.$_POST["codigo"];
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if ($_POST ['acao']=='alterar'){
				$sql = "update usuario set usuario='".$_POST["usuario"]."', senha='".$_POST["senha"]."',empresa=".$_SESSION["empresa"]."  where (empresa=".$_SESSION["empresa"].") and (codigo=".$_POST["codigo"].");";
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if( $_POST['acao']=='inserir'){
				$sql = "insert into usuario (usuario, senha, empresa) values ('".$_POST["usuario"]."','".$_POST["senha"]."',".$_SESSION["empresa"].");";
				//echo $sql;
				mysql_query($sql, $link);
			}
				
		?>
		<table border="1">
			<tr>
				<td>codigo</td>
				<td>usuario</td>
				<td>senha</td>
			</tr>
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql    = "SELECT codigo,usuario,senha FROM usuario  where (empresa=".$_SESSION["empresa"].") order by usuario asc;";
			$result = mysql_query($sql, $link);
			if (!$result) {
				echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			while ($row = mysql_fetch_assoc($result)){
		?>
				<tr>
					<td><a href="?codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?><a/></td>
					<td><?php echo $row['usuario'];?>&nbsp </td>                
					<td><?php echo $row['senha'];?>&nbsp </td>
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
