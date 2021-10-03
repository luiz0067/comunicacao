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
	$sql	= "SELECT codigo,imagem FROM fotos_slide_show  where (fotos_slide_show.empresa=0".$_SESSION["empresa"].") and (codigo=0".$_GET["codigo"].")";
	$result=mysql_query($sql, $link);
	$row = mysql_fetch_assoc($result);
	if ($result!=null)
		$imagem_antiga=$row["imagem"];
}
?>
<center>
	<div style="height:100px;display:block;">
<?php
if ($_POST) {
	$folder = "..\\upload\\imagens\\fotos_slide_show\\";
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
		if (($_FILES["imagem"]["size"] < 5*1024*1024)){
			if ($_FILES["imagem"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["imagem"]["error"] . "<br />";
			}
			else
			{
				echo "Tipo: " . $_FILES["imagem"]["type"] . "<br />";
				echo "Tamanho: " . ($_FILES["imagem"]["size"] / 1024) . " Kb<br />";
				$imagem=$_FILES["imagem"]["name"];
				$extension=strtolower(end(explode(".", $imagem)));
				$imagem=time().".".$extension;
				if (file_exists($folder . "p_".$imagem))
				{
					$imagem=time().".".$extension;
										
				}
				move_uploaded_file(
					$_FILES["imagem"]["tmp_name"],
					$folder . $imagem
				);				
				redimensiona($folder . $imagem,$folder.$imagem,1050,300,75);
				//unlink($folder . $imagem);
				//delete_file($folder . $imagem);	
				echo "<a href=\"../upload/imagens/fotos_slide_show/".$imagem."\" target=\"blank\">".$imagem."</a><br>";
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
			if(file_exists( $folder . $imagem_antiga))
			unlink($folder.$imagem_antiga);
		}
		$sql = "update fotos_slide_show set imagem='".$imagem."',fotos_slide_show.empresa=".$_SESSION["empresa"]."  where (fotos_slide_show.empresa=".$_SESSION["empresa"].") and (codigo=".$_POST["codigo"].");";
		mysql_query($sql, $link);
	}
	else if( $_POST['acao']=='inserir'){
		$sql = "insert into fotos_slide_show (imagem,fotos_slide_show.empresa) values ('".$imagem."',".$_SESSION["empresa"].");";
		//echo $sql;
		mysql_query($sql, $link);
	}
	else if ($_POST['acao']=='excluir'){
		//delete_file($folder . $imagem_antiga);
		$sql = "delete FROM fotos_slide_show  where (fotos_slide_show.empresa=".$_SESSION["empresa"].") and codigo=".$_POST["codigo"];
		//echo $sql;
		mysql_query($sql, $link);
	}
	$redirect = "upload.php?success";
}
?>
</div>
	<form method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table >
			<tr>
				<td>codigo:</td>
				<td><input name="codigo" type="text" value="<?php if ($result!=null) echo $row["codigo"]?>"></td>
			</tr>
			<tr>
				<td>imagem:</td>
				<td><input name="imagem" type="file" ></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="acao" value="inserir">
					<input type="submit" name="acao" value="excluir">
					<input type="button" value="limpar" onclick="self.location.href='?codigo'">	
				</td>
			</tr>
		</table>
	</form>
		<table border="1">
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql    = "select f.codigo, f.imagem,f.empresa from fotos_slide_show f where (f.empresa=".$_SESSION["empresa"].");";
			$result = mysql_query($sql, $link);
			if (!$result) {
				echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			$i=0;
			while ($row = mysql_fetch_assoc($result)){
			
		?>
			
				<tr>
					<td><a href="?projetos=<?php echo $_GET["projetos"]?>&codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?><a/></td>
					<td>
						<?php if($row['imagem']!=""){?>
						<a href="../upload/imagens/fotos_slide_show/<?php echo $row['imagem'];?>" target="_blank">ampliar<a/><br>
						<img width="100px" height="100px" src="../upload/imagens/fotos_slide_show/<?php echo $row['imagem'];?>">
						<?php }else{ ?>&nbsp;<?php }?>
					</td>
					<td><?php echo $row['nome'];?>&nbsp </td>
				</tr>
			<?php
			}
			mysql_free_result($result);
			?>
		</table>
</center>
<?php
	include('rodape.php');
?>
