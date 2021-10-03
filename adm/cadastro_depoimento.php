<?php
include('cabecalho.php');
function redimensiona($origem,$destino,$maxlargura,$maxaltura,$qualidade){
	list($largura, $altura) = getimagesize($origem);
	if($altura>$largura){
		$diferenca=$altura/$maxaltura;
		$maxlargura=$largura/$diferenca;
	}
	else{
		$diferenca=$largura/$maxlargura;
		$maxaltura=$altura/$diferenca;
	}
	$image_p = ImageCreateTrueColor($maxlargura,$maxaltura)	or die("Cannot Initialize new GD image stream");	
	$origem = imagecreatefromjpeg($origem);
	imagecopyresampled($image_p, $origem, 0, 0, 0, 0,  $maxlargura, $maxaltura, $largura, $altura);
	imagejpeg($image_p, $destino, $qualidade);
	imagedestroy($image_p);
	imagedestroy($origem);
}
$row=null;
$result=null;
if (($_GET["codigo"]!=null)){
	$sql	= "SELECT * FROM depoimento  where (empresa=".$_SESSION["empresa"].") and (codigo=0".$_GET["codigo"].")";
	$result=mysql_query($sql, $link);
	$row = mysql_fetch_assoc($result);
	if ($result!=null)
		$imagem_antiga=$row["imagem"];
}
?>
<center>
<div style="height:100px;display:block;">
<?php
if ($_POST){
	$folder = "..\\upload\\imagens\\depoimento\\";
	if (
		(
			($_FILES["imagem"]["type"] == "image/gif")
			|| 
			($_FILES["imagem"]["type"] == "image/jpeg")
			|| 
			($_FILES["imagem"]["type"] == "image/pjpeg")
			|| 
			($_FILES["imagem"]["type"] == "image/png")
			|| 
			($_FILES["imagem"]["type"] == "image/bmp")
		)
	)
	{
		echo "Return Code: ";
		if (($_FILES["imagem"]["size"] < 5*1024*1024)){
			if ($_FILES["imagem"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["imagem"]["error"] . "<br />";
			}
			else
			{
				echo "Tipo: " . $_FILES["imagem"]["type"] . "<br />";
				echo "Tamanho: " . ($_FILES["imagem"]["size"] / 1024) . " Kb<br />";
				//echo "Temp file: " . $_FILES["imagem"]["tmp_name"] . "<br />";
				$imagem=$_FILES["imagem"]["name"];
				$extension=strtolower(end(explode(".", $imagem)));
				if (file_exists($folder . "p_".$imagem))
				{
					$imagem=time().".".$extension;
				}
				move_uploaded_file(
					$_FILES["imagem"]["tmp_name"],
					$folder . $imagem
				);				
				redimensiona($folder . $imagem,$folder."h_".$imagem,800,600,75);
				redimensiona($folder . $imagem,$folder."g_".$imagem,224,230,75);
				redimensiona($folder . $imagem,$folder."m_".$imagem,80,80,75);
				redimensiona($folder . $imagem,$folder."p_".$imagem,32,32,75);
				unlink($folder . $imagem);
				//delete_file($folder . $imagem);	
				echo "<a href=\"../upload/imagens/depoimento/p_".$imagem."\" target=\"blank\">".$imagem."</a><br>";
			}
		}
		else
		{
			echo "Tamanho muito grande<br>";
		}
	}
	else
	{
		$imagem=$imagem_antiga;
	}
	if ($_POST ['acao']=='alterar'){
		if ($imagem_antiga!=""){
			if(file_exists($folder . $imagem_antiga))
			unlink($folder . $imagem_antiga);
		}
		if ($imagem=="")
			$sql = "update depoimento set  titulo='".$_POST["titulo"]."',empresa=".$_SESSION["empresa"]."  where (empresa=".$_SESSION["empresa"].") and (codigo=".$_POST["codigo"].");";
		else
			$sql = "update depoimento set imagem='".$imagem."', titulo='".$_POST["titulo"]."',empresa=".$_SESSION["empresa"]."  where (empresa=".$_SESSION["empresa"].") and (codigo=".$_POST["codigo"].");";
		mysql_query($sql,$link);
		$sql = "commit";
		mysql_query($sql,$link);
	}
	else if( $_POST['acao']=='inserir'){
		$sql = "insert into depoimento(imagem,titulo,empresa)values('".$imagem."','".$_POST["titulo"]."',".$_SESSION["empresa"].");";
		mysql_query($sql, $link);		
		$sql = "commit";
		mysql_query($sql,$link);
	}
	else if ($_POST['acao']=='excluir'){
		if(file_exists($folder . $imagem_antiga)){
			delete_file($folder.$imagem_antiga);
		}
		$sql = "delete FROM depoimento  where (empresa=".$_SESSION["empresa"].") and codigo=".$_POST["codigo"];
		mysql_query($sql, $link);
		//echo $sql;
		$sql = "commit";
		mysql_query($sql, $link);
	}
	$redirect = "upload.php?success";
}
?>
</div>
	<form  method="post" enctype="multipart/form-data">
		<table >
			<tr>
				<td>codigo:</td>
				<td><input name="codigo" type="text" value="<?php if ($result!=null) echo $row["codigo"]?>"></td>
			</tr>
			<tr>
				<td>descrição:</td>
				<td><textarea name="titulo"><?php if ($result!=null) echo $row["titulo"]?></textarea></td>
			</tr>
			<tr>
				<td>imagem:</td>
				<td><input name="imagem" type="file" ></td>
			</tr>
			<input name="imagem" type="hidden" value="<?php if ($result!=null) echo $row["imagem"]?>">
			<tr>
				<td colspan="2">
					<input type="submit" name="acao" value="inserir">
					<input type="submit" name="acao" value="alterar">
					<input type="submit" name="acao" value="excluir">
					<?php if($row["codigo"]!=null){?><a href="./cadastro_foto_depoimento.php?depoimento=<?php echo $row["codigo"]?>" target="_blank"><input type="button" value="inserir fotos"></a><?php }?>
					<input type="button" value="limpar" onclick="self.location.href='?codigo'">	
				</td>
			</tr>
		</table>
	</form>
		<table border="1">
			<tr>
				<td>codigo</td>
				<td>descrição</td>
			</tr>		
		<?php
			
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql="SELECT depoimento.codigo,depoimento.titulo,depoimento.descricao,depoimento.imagem,depoimento.empresa	 FROM depoimento where(depoimento.empresa=".$_SESSION["empresa"].");";
			$result = mysql_query($sql, $link);
			if (!$result) {
				echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}			
			
			if ($result!=null)
			while($row = mysql_fetch_assoc($result)){				
			?>
				<tr>
					<td>
						<a href="?codigo=<?php echo $row['codigo'];?>" target="_self"><?php echo $row['codigo'];?></a>
					</td>
					<td>&nbsp;<?php echo $row['titulo'];?>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">
						<?php if($row['imagem']!=""){?>
						<a href="../upload/imagens/depoimento/h_<?php echo $row['imagem'];?>" target="_blank">ampliar</a><br>
						<img width="100px" height="100PX" src="../upload/imagens/depoimento/g_<?php echo $row['imagem'];?>">
						<?php }else{?>&nbsp;
						<?php }?>
					</td>
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
