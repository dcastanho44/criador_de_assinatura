<?php

    $token = $_GET['token'];

    include_once('./classes/Database.class.php');
    include_once('./classes/Assinatura.class.php');
    include_once('./classes/Funcao.class.php');
    $db = new Database();
    $funcao = new Funcao();

    $id = $_GET['id'];

    $query = "SELECT * FROM test.tb_assinaturas WHERE id = {$id}";
    
    $db->query = $query;
    $db->content = NULL;

    $rows = ($db->select());
    foreach($rows as $select){
        $nome = ($select->nome);
        $empresa = ($select->empresa);
    }

    $query = "DELETE FROM test.tb_assinaturas WHERE id = ?";
    $content = array();
    $content[] = array ($id, 'int');
    $db->query = $query;
    $db->content = $content;
    $db->delete();

    @$arquivo = $funcao->obter_arquivo($nome, $empresa);
    @$arquivo = Assinatura::removeAcento("$nome-$empresa");
    @$arquivo = strtolower($arquivo);
    @$arquivo = trim($arquivo);
    @$arquivo = str_replace(' ', '_', $arquivo);

    unlink("./assets/images/assinaturas/$arquivo.jpg");
   
?>

    <div class="alert alert-info mt-2" role="alert" align="center">
        Assinatura de "<b><?php echo $nome ?></b>" removida
    </div>
    <div class="button-group mt-2 mb-2">
        <button type="button" class="btn btn-primary btn-sm" onclick="location.href='?token=<?php echo $token ?>'"><i class="fa-solid fa-arrow-left"></i> Voltar</button>
    </div>
