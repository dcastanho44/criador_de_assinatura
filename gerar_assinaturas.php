<?php

    //Script que gera a imagem de todas as assinaturas salvas no banco

    include_once('./classes/Database.class.php');
    include_once('./classes/Assinatura.class.php');
    include_once('./classes/Funcao.class.php');
    $db = new Database();
    $funcao = new Funcao();

    $query = "SELECT * FROM tb_assinaturas ORDER BY nome ASC";
    
    $db->query = $query;
    $db->content = NULL;

    $rows = ($db->select());
    foreach($rows as $select){
        $id = ($select->id);
        $email = ($select->email);
        $nome = ($select->nome);
        $cargo = ($select->cargo);
        $whatsapp = ($select->whatsapp);
        $telefone = ($select->telefone);
        $telefone2 = ($select->telefone2);
        $empresa = ($select->empresa);

        $image = Assinatura::criar_imagem($nome, $cargo, $whatsapp, $telefone, $telefone2);

        $nome_arquivo = $funcao->obter_arquivo($nome, $empresa);

        $filename = "assets/images/assinaturas/$nome_arquivo";
        imagepng($image, $filename);
        imagedestroy($image);

    }
?> 