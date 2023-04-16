<?php

    $token = $_GET['token'];

	ini_set('display_errors',1); ini_set('display_startup_erros',1); error_reporting(E_ALL); 
	ini_set('memory_limit', '-1'); date_default_timezone_set('America/Sao_Paulo');
    
    include_once(__DIR__ . '/../classes/Database.class.php');
    include_once(__DIR__ . '/../classes/Funcao.class.php');
    include_once(__DIR__ . '/../classes/Assinatura.class.php');
    $db = new Database();
    $funcao = new Funcao();
    $assinatura = new Assinatura();
    
    if(@$_GET['id']){
        $id = $_GET['id'];
        
        // $db->query = "SELECT * FROM tb_assinaturas WHERE id = $id";
        // $db->content = NULL;
        // $rows = ($db->select());
        $rows = $assinatura->obterAssinatura($id);
        foreach($rows as $select) {
            $id = ($select->id);
            $email = ($select->email);
            $nome = ($select->nome);
            $cargo = ($select->cargo);
            $whatsapp = ($select->whatsapp);
            $telefone = ($select->telefone);
            $telefone2 = ($select->telefone2);
            $empresa = ($select->empresa);
        }
    }
?>  
    <div class="container">
        <div class="titulo" align="center">
            <?php if (!isset($id)): ?>
                <h3 class="mt-1">Adicionar Assinatura</h3>
            <?php else: ?>
                <h3 class="mt-1">Editar Assinatura</h3>
                <hr>
                <div class="image">
                    <?php $arquivo = $funcao->obter_arquivo($nome, $empresa) ?>
                    <img src="./assets/images/assinaturas/<?php echo $arquivo ?>" width="500px">
                </div>
                <hr>
            <?php endif; ?>
        </div>
        <form name="form1" action="index.php?token=<?php echo $token?>&view=gerador_assinatura" method="post">
            <div class="formulario">
                <div class="row"> 
                    <div class="col-md-6 offset-md-3">
                        <table class="table-borderless" id="table_form_assinatura">
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        Empresa <b>*</b>
                                        <select id="empresa" name="empresa" class="form-control" required>
		    				        	<option value="">Selecione a empresa</option>
                                        <option value="Generic" <?php "Generic" ? 'selected' : '' ?> >Generic</option>
		    				            </select>
                                    </td>
                                <tr>
                                    <td colspan="6">Nome <b>*</b> <input type="text" class="form-control" name="nome" id="nome" value="<?php echo isset($_GET['id']) ? @$nome : "" ?>" required></td>
                                </tr>
                                <tr>
                                    <td colspan="6">E-mail<input type="text" class="form-control" name="email" id="email" value="<?php echo isset($_GET['id']) ? @$email : "" ?>"></td>
                                </tr>
                                <tr>
                                <td colspan="6">
                                    Cargo <b>*</b>
                                    <div id="input-text-cargo"></div>
                                    <select id="cargo" name="cargo" class="form-control" required>
		    				            <option value="">Selecione o cargo</option>
                                        <option value="">                   </option>
                                        <?php
                                            $db->query = "SELECT DISTINCT cargo FROM tb_assinaturas ORDER BY cargo ASC";
                                            $db->content = NULL;
                                            $rows = ($db->select());
                                            foreach($rows as $select) :
                                                $cargos = ($select->cargo);                                            
                                        ?>
                                        <option value="<?php echo $cargos ?>" <?php echo ($cargos == @$cargo) ? 'selected' : '' ?> ><?php echo $cargos ?></option>
                                        <?php endforeach ?>
                                        <option value="">                   </option>
                                        <option value="1">+ Adicionar novo cargo</option>
		    				        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Whatsapp <input type="tel" onkeydown="return mascaraTelefone(event)" class="form-control phone-number" name="whatsapp" id="whatsapp" value="<?php echo isset($_GET['id']) ? @$whatsapp : "" ?>"></td>
                                </tr>
                                    <td>Telefone 1 <input type="tel" onkeydown="return mascaraTelefone(event)" class="form-control phone-number" name="telefone" id="telefone"  value="<?php echo isset($_GET['id']) ? @$telefone : "" ?>"></td>
                                    <td>Telefone 2 <input type="tel" onkeydown="return mascaraTelefone(event)" class="form-control phone-number" name="telefone2" id="telefone2" value="<?php echo isset($_GET['id']) ? @$telefone2 : "" ?>"></td>
                                </tr>
                            </tbody>
                        </table>
                        <b>* </b><small>Campos obrigatórios</small>
                        <div class="button-group mb-3 mt-2">
                            <input type="hidden" name="token" value="<?php echo $token ?>">
                            <?php if(isset($id)): ?>
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i> Salvar</button>
                            <?php else: ?>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-file-circle-plus"></i> Salvar</button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-primary btn-sm" onclick='history.go(-1)'><i class="fa-solid fa-arrow-left"></i> Voltar</button>
                        </div>
                    </div>
                    <br><br>
                </div>
            </div>
        </form>
    </div>