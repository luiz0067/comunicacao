<?php
$host		=	"YOUR HOST";
	$login		=	"USER NAME";
	$password	=	"PASSWORD";
	$base_dados	=	"DATABASE";
if (!$link = mysql_connect($host, $login, $password)) {
    echo 'Não foi possível conectar ao mysql';
    exit;
}

if (!mysql_select_db($base_dados, $link)) {
    echo 'Não foi possível selecionar o banco de dados';
    exit;
}


?>
