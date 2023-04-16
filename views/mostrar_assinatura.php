<?php

    $token = $_GET['token'];

    include_once(__DIR__ . '/../classes/Database.class.php');
    include_once(__DIR__ . '/../classes/Assinatura.class.php');
    include_once(__DIR__ . '/../classes/Funcao.class.php');
    $db = new Database(true);
    $funcao = new Funcao();
    
    $id = $_GET['id'];
    $id = (int)$id;

    $query = "SELECT * FROM test.tb_assinaturas WHERE id = {$id}";
    
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
    }
    
    @$arquivo = $funcao->obter_arquivo($nome, $empresa);
    @$arquivo = Assinatura::removeAcento("$nome-$empresa");
    @$arquivo = strtolower($arquivo);
    @$arquivo = trim($arquivo);
    @$arquivo = str_replace(' ', '_', $arquivo);

?>
    <div class="container">
        <?php if (@$_GET['msg'] == 'add_error'): ?>
            <div class="container">
                <div class="alert alert-danger" role="alert" align="center">
                    <?php echo 'A assinatura já existe, favor usar a opção de editar'; ?>
                </div>
            </div>
            <div class="button-group mt-2 mb-4 d-flex justify-content-center">
                <button type="button" class="btn btn-primary btn-sm" onclick="history.go(-1)"><i class="fa-solid fa-arrow-left"></i> Voltar</button>
            </div>
            <?php exit; ?>

        <?php elseif(@$_GET['msg']): ?>
            <div class="container">
                <div class="alert alert-success" role="alert" align="center">
                    <?php if ($_GET['msg'] == 'edit_success') echo 'Assinatura atualizada'; ?>
                    <?php if ($_GET['msg'] == 'add_success') echo 'Assinatura adicionada com sucesso'; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php 
            if (@$_GET['msg']) {
                $previous = "location.href='?token=$token'";
            } else {
                $previous = "history.go(-1)";
            }
        ?>
        <?php if (@$_GET['msg'] != 'add_error'): ?>
            <hr>
            <div class="image" align="center">
                <img src="./assets/images/assinaturas/<?php echo $arquivo.".jpg" ?>" width="500px">
                <br>
                <span class="copied"></span>
                <!-- <div class="copy-html mt-2">
                <small>Clique abaixo para copiar:</small>
                <br>
                    <pre title="Clique para copiar!" class="clipboard badge badge-secondary"
                        data-clipboard-text="<?php echo htmlentities('<img src="" width="350px">'); ?>"
                        style="color:white;cursor:pointer;font-size:16px;" onclick="alert('Copiado para área de transferência')"><?php echo htmlentities('<img src="">'); ?> <i class="fa-solid fa-copy"></i>
                    </pre>
                </div> -->
            </div>
            <hr>
        <?php endif; ?>
        <div class="button-group mt-2 mb-4 d-flex justify-content-center">
            <a href="?token=<?php echo $token ?>&view=form_assinatura&id=<?php echo $id?>" class="btn btn-info btn-sm"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
            <a href="?token=<?php echo $token ?>&view=excluir_assinatura&id=<?php echo $id?>" class="btn btn-info btn-danger btn-sm ml-1 mr-1" onclick="return confirm('Tem certeza que deseja excluir?');"><i class="fa-regular fa-trash-can"></i> Excluir</a>
            <button type="button" class="btn btn-primary btn-sm" onclick="<?php echo $previous ?>"><i class="fa-solid fa-arrow-left"></i> Voltar</button>
        </div>
    </div>


