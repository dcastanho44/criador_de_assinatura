
<?php

    include_once(__DIR__ . '/../classes/Database.class.php');
    include_once(__DIR__ . '/../classes/Assinatura.class.php');
    include_once(__DIR__ . '/../classes/Funcao.class.php');
    $db = new Database();
    $funcao = new Funcao();

    $erros = array();

    $token          = @$_POST['token'];
    $id             = @$_POST['id'];
    $empresa        = @$_POST['empresa'];
    $nome           = @$_POST['nome'];
    $email          = @$_POST['email'];
    $cargo          = @$_POST['cargo'];
    $whatsapp       = @$_POST['whatsapp'];
    $telefone       = @$_POST['telefone'];
    $telefone2      = @$_POST['telefone2'];

?>
    <?php 
        if (!$funcao->validar_telefone($whatsapp)) {
            $erros[] = 'Whatsapp Inválido';
        }

        if (!$funcao->validar_telefone($telefone)) {
            $erros[] = 'Telefone Inválido';
        }

        if (!$funcao->validar_telefone($telefone2)) {
            $erros[] = 'Telefone 2 Inválido';
        }

        if (!$funcao->validar_email($email)) {
            $erros[] = 'Email Inválido';
        }

        if ($cargo == ""){
            $erros[] = 'Cargo Inválido';
        }

    ?>
    
    <?php if ($erros) : ?>
        <div class="container">
            <div class="alert alert-danger mt-2 mb-2" role="alert" align="center">
                <h4 class="alert-heading">Erro</h4>
                <hr>
                <?php echo implode("<br>", $erros) ?>
            </div>
        </div>
        <div class="back" align="center">
            <?php echo "<a href=\"javascript:history.go(-1)\">Voltar</a>"; ?>
        </div>    
    <?php else :
    
        if (!isset($id)) 
        {

            $db->query = "SELECT * FROM tb_assinaturas WHERE nome = '$nome' AND empresa = '$empresa'";
            $db->content = NULL;
            $rows = ($db->select());
            foreach($rows as $select) 
            {
                $nome_old = ($select->nome);
                $empresa_old = ($select->empresa);
            }

            if (isset($nome_old) && isset($empresa_old))
            {
                if ($nome == $nome_old && $empresa == $empresa_old) 
                {
                    $msg = 'add_error';
                    header("Location: index.php?view=mostrar_assinatura&id=$id&msg=$msg");
                    exit();
                }
            }
            else
            {
                $query  = "INSERT INTO tb_assinaturas (email, nome, cargo, whatsapp, telefone, telefone2, empresa) ";
                $query .= "VALUES (?, ?, ?, ?, ?, ?, ?)";

                $content = array();

                $content[] = array($email);
                $content[] = array($nome);
                $content[] = array($cargo);
                $content[] = array($whatsapp);
                $content[] = array($telefone);
                $content[] = array($telefone2);
                $content[] = array($empresa);
                
                $db->query = $query;
                $db->content = $content;
                
                $id = $db->insertId();
                $msg = 'add_success';
            }
        }
        elseif (isset($id))
        {   

            $db->query = "SELECT * FROM tb_assinaturas WHERE id = $id";
            $db->content = NULL;
            $rows = ($db->select());
            foreach($rows as $select) {
                $nome_old = ($select->nome);
                $empresa_old = ($select->empresa);
            }

            $query  = "UPDATE tb_assinaturas SET ";
            $query .= "email = ?, nome = ?, cargo = ?, whatsapp = ?, telefone = ?, telefone2 = ?, empresa = ? ";
            $query .= "WHERE id = ?";

            $content = array();

            $content[] = array($email);
            $content[] = array($nome);
            $content[] = array($cargo);
            $content[] = array($whatsapp);
            $content[] = array($telefone);
            $content[] = array($telefone2);
            $content[] = array($empresa);

            $content[] = array($id);
        
            $db->query = $query;
            $db->content = $content;
        
            $db->update();
            $msg = 'edit_success';
        }
        else
        {
            echo "erro";
        }


        $image = Assinatura::criar_imagem($nome, $cargo, $whatsapp, $telefone, $telefone2);

        $nome_arquivo = $funcao->obter_arquivo($nome, $empresa);

        $filename = "./assets/images/assinaturas/$nome_arquivo";
        imagepng($image, $filename);
        imagedestroy($image);

        header("Location: ?token=$token&view=mostrar_assinatura&id=$id&msg=$msg");
        exit();
    
    endif; ?>