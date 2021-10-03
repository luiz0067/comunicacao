<html>
	<head>
		<script type="text/javascript">			
		</script>
		<style type="text/css">			
		</style>
	</head>
	<body>
		<form>
			nome:<input type="text" name="nome"><br>
			<input type="submit" name="acao" value="ok"><br>
		</form>
		<?
			$variavel=$_GET["nome"];
			echo "ola .$variavel. !";
		?>
	</body>
</html>