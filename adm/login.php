<?php
	ob_start();
	include('conecta.php');
	$phpver = phpversion(); 
	if ($phpver >= '4.0.4pl1') {
		if (extension_loaded('zlib')) { 
			ob_end_clean(); 
			ob_start('ob_gzhandler'); 
		} 
	}
	$linha=null;
	$result=null;
	$sql	= "SELECT codigo,usuario,senha,empresa FROM usuario  where (empresa=".$_POST["empresa"].")and(usuario='".$_POST["usuario"]."') and( senha='".$_POST["senha"]."')";
	$result=mysql_query($sql, $link);
	if (($result!=null)&&($_POST["usuario"]!=null)&&($_POST["senha"]!=null)){
		$linha = mysql_fetch_assoc($result);
		if (($_POST["usuario"]==$linha["usuario"]) && ($_POST["senha"]==$linha["senha"])){
			session_start();
			$_SESSION["codigo"]		= $linha["codigo"];
			$_SESSION["usuario"]	= $linha["usuario"];
			$_SESSION["empresa"]	= $_POST["empresa"];
			$_SESSION["meu_tempo"]  = time();
			header("location:principal.php");
		}
		else{?>
			<div style="color:#FF0000">Usuario ou senha inválido</div>
			<?php mysql_free_result($result);
		}
	}
	
?>
<html>
	<head>
	<script type="text/javascript">
	</script>
	<style type="text/css">
	</style>
	</head>
	<body>
		<center>
			<form method="post">
				<table>
			<tr>
		    <td>empresa:</td>
			<td><input type="hidden" name="empresa" value="1"></td><!--comunicação-->							
		</tr>
					<tr>
						<td>usuario:</td>
						<td><input type="text" name="usuario"></td>
					</tr>
					<tr>
						<td>senha:</td>
						<td><input type="password" name="senha"></td>
					</tr>
					<tr>
						<td><input type="submit" name="acao" value="ok"></td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>