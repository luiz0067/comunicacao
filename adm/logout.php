<?php
	if (isset($_SESSION))
	{
		session_start();
		$_SESSION = array();
		//Elimina os dados da sessão
		session_unregister($_SESSION['codigo']);
		session_unregister($_SESSION['usuario']);
		session_unregister($_SESSION['time']);
		//Encerra a sessão
		session_destroy();		
	}
	header("Location:index.php");
?>	