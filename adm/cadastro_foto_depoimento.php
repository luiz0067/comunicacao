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
	imagecopyresampled($image_p,$origem,0,0,0,0,$maxlargura,$maxaltura,$largura,$altura);
	imagejpeg($image_p,$destino,$qualidade);
	imagedestroy($image_p);
	imagedestroy($origem);
} 
$row=null;
$result=null;
$depoimento=null; 
if (($_GET["depoimento"]!=null)){
	$depoimento=$_GET["depoimento"];
}
else{
	$depoimento=$_POST["depoimento"];
}
if (($_GET["codigo"]!=null)){
	$sql	= "SELECT codigo,imagem,nome,depoimento FROM fotos_depoimento where(empresa=".$_SESSION["empresa"].")and(codigo=0".$_GET["codigo"].")and(depoimento=".$depoimento.")";
	$result=mysql_query($sql, $link);
	$row = mysql_fetch_assoc($result);
	if ($result!=null)
		$imagem_antiga=$row["imagem"];
}
?>
<center>
<div style="height:100px;display:block;">
<?php
if($_POST){
	$folder = "..\\upload\\imagens\\depoimento\\fotos_depoimento\\";
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
				echo "Return Code: " . $_FILES["imagem"]["error"] . "<br/>";
			}
			else
			{
				//echo "Upload: " . $_FILES["imagem"]["name"] . "<br />";
				echo "Tipo: " . $_FILES["imagem"]["type"] . "<br />";
				echo "Tamanho: " . ($_FILES["imagem"]["size"] / 1024) . " Kb<br />";
				//echo "Temp file: " . $_FILES["imagem"]["tmp_name"] . "<br />";
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
				redimensiona($folder . $imagem,$folder."h_".$imagem,800,600,75);
				redimensiona($folder . $imagem,$folder."g_".$imagem,224,230,75);
				redimensiona($folder . $imagem,$folder."m_".$imagem,80,80,75);
				redimensiona($folder . $imagem,$folder."p_".$imagem,32,32,75);
				unlink($folder . $imagem);
				//delete_file($folder . $imagem);	
				echo "<a href=\"../upload/imagens/depoimento/fotos_depoimento/p_".$imagem."\" target=\"blank\">".$imagem."</a><br>";
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
			unlink($folder . $imagem_antiga);
		}
		if ($imagem=="")
			$sql = "update fotos_depoimento set  nome='".$_POST["nome"]."',link='".$_POST["link"]."',depoimento='".$depoimento."',empresa=".$_SESSION["empresa"]."  where (empresa=".$_SESSION["empresa"].") and (codigo=".$_POST["codigo"].")and(depoimento=".$depoimento.");";
		else
			$sql = "update fotos_depoimento set imagem='".$imagem."', nome='".$_POST["nome"]."',link='".$_POST["link"]."',depoimento='".$depoimento."',empresa=".$_SESSION["empresa"]." where(empresa=".$_SESSION["empresa"].")and(codigo=".$_POST["codigo"].")and(depoimento=".$depoimento.");";
		//echo $sql;
		mysql_query($sql, $link);
	}
	else if( $_POST['acao']=='inserir'){
		$sql = "insert into fotos_depoimento(imagem,nome,link,depoimento,empresa) values ('".$imagem."','".$_POST["nome"]."','".$_POST["link"]."',".$depoimento.",".$_SESSION["empresa"].");";
		mysql_query($sql, $link);
	}
	else if ($_POST['acao']=='excluir'){
		//delete_file($folder . $imagem_antiga);
		$sql = "delete from fotos_depoimento where(empresa=".$_SESSION["empresa"].")and(depoimento=".$depoimento.")and(codigo=".$_POST["codigo"].")";
		//echo $sql;
		mysql_query($sql, $link);
	}
	$redirect = "upload.php?success";
}
?>
</div>
	<form action="?depoimento=<?php echo $_GET["depoimento"]?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table>
			<tr>
				<td>codigo:</td>
				<td><input name="codigo" type="text" value="<?php if ($result!=null) echo $row["codigo"]?>"></td>
				<input name="depoimento" type="hidden" value="<?php echo $depoimento;s?>">
			</tr>
			<tr>
				<td>imagem:</td>
				<td><input name="imagem" type="file" ></td>
			</tr>
			<tr>
				<td>nome:</td>
				<td><input name="nome" type="text" value="<?php if ($result!=null) echo $row["nome"]?>"></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="acao" value="inserir">
					<input type="submit" name="acao" value="alterar">
					<input type="submit" name="acao" value="excluir">
					<input type="button" value="limpar" onclick="self.locatiod.href='?codigo'">	
				</td>
			</tr>
		</table>
	</form>
		<table border="1">
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql=" select f.codigo,f.depoimento,f.nome,f.imagem,f.link,f.empresa,d.titulo as depoimento_titulo,d.descricao as depoimento_descricacao from fotos_depoimento f left join depoimento d on (d.codigo=f.depoimento) where (f.empresa=".$_SESSION["empresa"].")and(depoimento=0".$_GET["depoimento"].")";
			//	echo $sql;
			$result = mysql_query($sql,$link);
			if (!$result){
				echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			$i=0;
			while ($row = mysql_fetch_assoc($result)){
				if($i==0){?>
			<tr bgcolor="#DDDDDD">
				<td>Codigo depoimento</td>
				<td colspan="2">nome</td>
			</tr>
			<tr>
				<td><?php echo $row['depoimento'];?></td>
				<td colspan="2"><?php echo $row['depoimento_titulo'];?></td>
			</tr>
			<tr bgcolor="#DDDDDD">
				<td>codigo</td>
				<td>imagem</td>
				<td>nome</td>
			</tr>
<?php			
				}
				$i++;
?>		
				<tr>
					<td><a href="?depoimento=<?php echo $_GET["depoimento"]?>&codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?><a/></td>
					<td>
						<?php if($row['imagem']!=""){?>
						<a href="../upload/imagens/depoimento/fotos_depoimento/h_<?php echo $row['imagem'];?>" target="_blank">ampliar</a><br>
						<img width="100px" height="100px" src="../upload/imagens/depoimento/fotos_depoimento/g_<?php echo $row['imagem'];?>">
						<?php }else{?>&nbsp;<?php }?>
					</td>
					<td><?php echo $row['nome'];?>&nbsp;</td>
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
