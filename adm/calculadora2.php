<html>
	<head>
		<script type="text/javascript">			
		</script>
		<style type="text/css">			
		</style>
	</head>
	<body>
		<form>
			valor1:<input type="text" name="valor1"><br>
			valor2:<input type="text" name="valor2"><br>
			<input type="submit" name="acao" value="+">
			<input type="submit" name="acao" value="-">
			<input type="submit" name="acao" value="*">
			<input type="submit" name="acao" value="/"><br>
		</form>
		<?
			$valor1=$_GET["valor1"];
			$valor2=$_GET["valor2"];
			if($_GET["acao"]!=null){
				if($_GET["acao"]=="+")
					$resultado=$valor1+$valor2;
				else if($_GET["acao"]=="-")
					$resultado=$valor1-$valor2;
				else if($_GET["acao"]=="*")
					$resultado=$valor1-$valor2;
				else if($_GET["acao"]=="/")
					$resultado=$valor1/$valor2;
			}
			echo "o resultado é .$resultado. !";
		?>
	</body>
</html>