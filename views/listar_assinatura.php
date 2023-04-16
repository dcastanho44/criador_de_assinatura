    <div class="add-assinatura mb-1">
        <?php $token = $_GET['token'] ?>
        <a href="?token=<?php echo $token ?>&view=form_assinatura" class="btn btn-dark mt-2 mb-1">Adicionar Assinatura 
        <i class="fa-solid fa-file-circle-plus"></i></a>
    </div>

<form method="get">
    <div class="input-group d-flex justify-content-between">
        <div class="col-xs-6">
            <div class="input-group d-inline-flex align-items">
                <div class="input-group-prepend">
                    <span class="input-group-text">Buscar por</span>
                </div>
                <input type="hidden" name="token" id="token" value="<?php echo $token ?>">
                <div class="input-group-append">
                    <select class="input-group-text" name="sl_filtro">
                        <option value="nome"
                            <?php echo (isset($_GET['sl_filtro']) && $_GET['sl_filtro'] == 'nome') ? 'selected' : ''; ?>>
                            Nome</option>
                        <option value="cargo"
                            <?php echo (isset($_GET['sl_filtro']) && $_GET['sl_filtro'] == 'cargo') ? 'selected' : ''; ?>>
                            Cargo</option>
                        <option value="empresa"
                            <?php echo (isset($_GET['sl_filtro']) && $_GET['sl_filtro'] == 'empresa') ? 'selected' : ''; ?>>
                            Empresa</option>
                    </select>
                </div>
                <input type="text" class="form-control" name="busca" id="busca" value="<?php echo $busca ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>

        <div class="d-inline-flex">
            <div class="input-group-prepend">
                <span class="input-group-text">Registros por página </span>
            </div>
            <div class="input-group-append">
                <form name="registros" method="get">
                    <select class="form-control" name="registros" onchange="this.form.submit()">
                        <option value="10"
                            <?php echo (isset($_GET['registros']) && $_GET['registros'] == '10') ? 'selected' : ''; ?>>10
                        </option>
                        <option value="20"
                            <?php echo (isset($_GET['registros']) && $_GET['registros'] == '20') ? 'selected' : ''; ?>>20
                        </option>
                        <option value="50"
                            <?php echo (isset($_GET['registros']) && $_GET['registros'] == '50') ? 'selected' : ''; ?>>50
                        </option>
                        <option value="100"
                            <?php echo (isset($_GET['registros']) && $_GET['registros'] == '100') ? 'selected' : ''; ?>>100
                        </option>
                    </select>
            </div>
        </div>
    </div>
</form>

<?php if(@$_GET['busca']): ?>
<div class="limpar_busca ml-3">
    <small><a href="index.php?token=<?php echo $token ?>" class="link-primary">Limpar Busca</a></small>
</div>
<?php endif; ?>
<?php
        $db->query = "SELECT * FROM tb_assinaturas $where ORDER BY nome ASC";
        $db->content = NULL;
        $rows = ($db->select());
        $count = 0;
        $registros = 0;
        foreach($rows as $select) {
            $count++;
        }

        $limit = isset($_GET['registros']) ? $_GET['registros'] : 10;

        $paginacao = new Pagination($count, $_GET['pagina'] ?? 1, $limit);
        $offset = $paginacao->getOffset();
        $page = '';
        $paginas = $paginacao->getPages();
        @$pagina_atual = $_GET['pagina'];
        foreach ($paginas as $key=>$pagina){
            unset($_GET['pagina']);
            $gets = http_build_query($_GET);
            $class = $pagina['atual'] ? 'btn-dark' : 'btn-light';
            $page .= '<a href="index.php?'.$gets.'&pagina='.$pagina['pagina'].'">
                        <button type="button" class="btn btn-sm '.$class.'" style="text-decoration: none;">'.$pagina['pagina'].'</button>
                        </a>';
        }
    ?>

<?php if ($count == 0): ?>
<div class="container">
    <div class="alert alert-danger mt-2 mb-2" role="alert" align="center">
        Nenhuma assinatura encontrada
    </div>
</div>
<div class="back" align="center">
    <small><a href="index.php?token=<?php echo $token ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-arrow-left"></i> Voltar</a></small>
</div>
<?php else: ?>
<br>
<table class="table table-bordered table-hover table-striped table-sm">
    <thead class="thead-dark">
        <tr>
            <th>Nome</th>
            <th>Cargo</th>
            <th>E-mail</th>
            <th>Whatsapp</th>
            <th>Telefone</th>
            <th>Telefone 2</th>
            <th>Empresa</th>
            <th class="text-center"><i class="fa-solid fa-gear"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $db->query = "SELECT * FROM tb_assinaturas $where ORDER BY nome ASC LIMIT $limit OFFSET $offset";
            $db->content = NULL;
            $rows = ($db->select());
            foreach($rows as $select) :
                $id         = ($select->id);
                $nome       = ($select->nome);
                $email      = ($select->email);
                $cargo      = ($select->cargo);
                $whatsapp   = ($select->whatsapp);
                $telefone   = ($select->telefone);
                $telefone2  = ($select->telefone2);
                $empresa    = ($select->empresa);
                $registros++;
        ?>

        <tr>
            <td><?php echo $nome ?></td>
            <td><?php echo $cargo ?></td>
            <td><?php echo $email ?></td>
            <td><?php echo $whatsapp ?></td>
            <td><?php echo $telefone ?></td>
            <td><?php echo $telefone2 ?></td>
            <td><?php echo $empresa ?></td>
            <td>
                <a href="?token=<?php echo $token ?>&view=mostrar_assinatura&id=<?php echo $id?>" class="btn btn-primary btn-sm"
                    data-toggle="tooltip" data-placement="top" title="Ver Assinatura"><i class="fa-regular fa-eye"></i>
                </a>
                <a href="?token=<?php echo $token ?>&view=form_assinatura&id=<?php echo $id?>" class="btn btn-info btn-sm"
                    data-toggle="tooltip" data-placement="top" title="Editar Assinatura"><i class="fa-regular fa-pen-to-square"></i>
                </a>
                <a href="?token=<?php echo $token ?>&view=excluir_assinatura&id=<?php echo $id?>" class="btn btn-danger btn-sm"
                    data-toggle="tooltip" data-placement="top" title="Excluir Assinatura"
                    onclick="return confirm('Tem certeza que deseja excluir?');"><i class="fa-regular fa-trash-can"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?php
    $gets = http_build_query($_GET);
    $numero_de_paginas = count($paginas);
?>

<div class="paginacao mt-2 mb-2" align="center">
    <div class="page-arrows">
        <?php if (($numero_de_paginas == 0) == false): ?>
            <?php if ($pagina_atual > 1): ?>
            <a href="index.php?<?php echo $gets; ?>&pagina=<?php echo $pagina_atual-1 ?>"
                class="btn btn-outline-dark btn-sm"><i class="fa-solid fa-arrow-left"></i></a>
            <?php else: ?>
            <a href="index.php?<?php echo $gets; ?>&pagina=<?php echo $pagina_atual-1 ?>"
                class="btn btn-outline-dark btn-sm disabled"><i class="fa-solid fa-arrow-left"></i></a>
            <?php endif; ?>

            <?php echo $page ?>

            <?php if ($pagina_atual < $numero_de_paginas && $pagina_atual != 0): ?>
            <a href="index.php?<?php echo $gets; ?>&pagina=<?php echo $pagina_atual+1 ?>"
                class="btn btn-outline-dark btn-sm"><i class="fa-solid fa-arrow-right"></i></a>
            <?php endif; ?>
            <?php if ($pagina_atual < $numero_de_paginas && $pagina_atual == 0): ?>
            <a href="index.php?<?php echo $gets; ?>&pagina=<?php echo $pagina_atual+2 ?>"
                class="btn btn-outline-dark btn-sm"><i class="fa-solid fa-arrow-right"></i></a>
            <?php endif; ?>
            <?php if ($pagina_atual == $numero_de_paginas): ?>
            <a href="" class="btn btn-outline-dark btn-sm disabled"><i class="fa-solid fa-arrow-right"></i></a>
            <?php endif;?>
        <?php endif; ?>
    </div>
</div>
<div>
    <?php $registros = $offset + $registros ?>
    <div class="showing mb-2" align="center">
        <?php echo "$registros de $count assinaturas" ?>
    </div>
</div>