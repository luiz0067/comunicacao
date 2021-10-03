<?php
$host		=	"mysql17.redehost.com.br";
	$login		=	"colombo";
	$password	=	"midiamix";
	$base_dados	=	"colombo";

if (!$link = mysql_connect($host, $login, $password)) {
    echo 'Não foi possível conectar ao mysql';
    exit;
}

if (!mysql_select_db($base_dados, $link)) {
    echo 'Não foi possível selecionar o banco de dados';
    exit;
}


?>