<?php include('conecta.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Empresa</title>
<link rel="stylesheet" type="text/css" href="estilos.css" />
<style type="text/css">
body {
	width:100%;
	height:100%;
	margin-left:0px;
	margin-right:0px;
	margin-bottom:0px;
	margin-top:0px;
	background-color:#2B2B2B;
}
</style>
</head>

<body>
<div id="colunaesquerdaprojeto">
            <div id="menuprojetos">
                <div class="titulomenuprojetos"><h1>:: Projetos</h1></div>
			<?php 
								
								$sql = "select c.codigo, c.nome from categoria c where (c.empresa='1') order by c.codigo desc ;";
								$result = mysql_query($sql, $link);
								if (!$result){
									echo "Erro do banco de dados, não foi possivel consultar o banco de dados\n";
									echo 'Erro MySQL: '. mysql_error();
									exit;
								}
								while ($row = mysql_fetch_assoc($result)){
									$i=0;
									$nome=$row ["nome"];
									$codigo=$row ["codigo"];
									
								?>
                <div class="caixamenu"><a class="menuprojeto" href="projetos.php?codigo=<?php echo $codigo;  ?>" target="_self"><?php echo $nome;  ?></a></div>
                <div class="riscomenuprojeto"></div>
				<?php }
						$i++;
					
				?>
               
            </div>
        </div>
</body>
</html>