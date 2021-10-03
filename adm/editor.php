<?php	
	include('cabecalho.php');
	$row=null;
	$result=null;
	$sql	= "SELECT codigo,nome,conteudo,data_inicio,data_fim FROM paginas  where (empresa=".$_SESSION["empresa"].") and(nome='home') and (data_fim is null) order by data_inicio desc";
	$result=mysql_query($sql, $link);
	$row = mysql_fetch_assoc($result);
	$conteudo=$row["conteudo"];
	$codigo=$row["codigo"];
	$data_inicio=$row["data_inicio"];
	if ($_POST['acao']=='atualizar pagina'){
		$conteudo=($_POST["conteudo"]);
		$conteudo=str_replace("\\\"", "\"", $conteudo);
		$data_hora=Date("Y-m-d H:i:s");    
		$sql = "insert into paginas (nome,conteudo,data_inicio) values ('home','".$conteudo."','".$data_hora."');";
		mysql_query($sql, $link);
		$sql = "update paginas set data_fim='".$data_hora."'  where (empresa=".$_SESSION["empresa"].") and(codigo=0".$codigo.");";
		mysql_query($sql, $link);			
	}
	
?>

	<title>editor de texto</title>
	
	<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
	<script src="./ckeditor/_samples/sample.js" type="text/javascript"></script>
	<link href="./ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		body{
			margin-top:0px;
			margin-left:0px;
			margin-right:0px;
			margin-button:0px;
		}
	</style>
	<?php
	
		
	?>
	<?php echo $data_inicio;?>
	<form action="?pagina=home" 
	method="post">
		<label for="editor1">Editor da pagina principal</label><br>
		<textarea class="ckeditor" style="width:100%;" name="conteudo" rows="10"><?php echo ($conteudo);?></textarea><br>
		<input type="submit" name="acao" value="atualizar pagina" />		
	</form>	
	
<?php
	include('rodape.php');
?>
