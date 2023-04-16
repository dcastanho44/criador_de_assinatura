<?php

    @session_start();
	ini_set("display_errors", "1");
	error_reporting(E_ALL);
	ini_set('memory_limit', '-1'); 
	date_default_timezone_set('America/Sao_Paulo');

	$token = '310781d3-eeed-4097-a769-0a413828eee9';

	if(!isset($_GET['token']) || ($token != $_GET['token'])){
		echo 'Acesso não autorizado';
		exit;
	}
    
    include_once('./classes/Database.class.php');
    include_once('./classes/Pagination.class.php');
    $db = new Database();

    include_once('templates/header.php');

		//Busca
		$busca = filter_input(INPUT_GET, 'busca', FILTER_UNSAFE_RAW);

		$condicoes = [
			isset($busca) ? 'WHERE '.$_GET['sl_filtro'].' LIKE "%'.$busca.'%"' : null 
		];

		$where = implode(' AND ', $condicoes);
		
		switch (@$_GET['view']) {
			case 'form_assinatura':
				include_once("views/form_assinatura.php");
			break;
			case 'gerador_assinatura':
				include_once("views/gerador_assinatura.php");
			break;
			case 'mostrar_assinatura':
				include_once("views/mostrar_assinatura.php");
			break;
			case 'excluir_assinatura':
				include_once("views/excluir_assinatura.php");
			break;
			default:
				include_once("views/listar_assinatura.php");
			break;
		}

		include_once('templates/footer.php');
	?>
