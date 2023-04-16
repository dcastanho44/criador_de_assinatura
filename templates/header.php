<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/fonts/news-cycle-regular.ttf">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/clipboard.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <script type="text/javascript">

        function mascaraTelefone(event) {
            let tecla = event.key;
            let telefone = event.target.value.replace(/\D+/g, "");

            if (/^[0-9]$/i.test(tecla)) {
                telefone = telefone + tecla;
                let tamanho = telefone.length;

                if (tamanho >= 12) {
                    return false;
                }

                if (tamanho > 10) {
                    telefone = telefone.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
                } else if (tamanho > 5) {
                    telefone = telefone.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
                } else if (tamanho > 2) {
                    telefone = telefone.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
                } else {
                    telefone = telefone.replace(/^(\d*)/, "($1");
                }

                event.target.value = telefone;
            }

            if (!["Backspace", "Delete"].includes(tecla)) {
                return false;
            }
        }
        
        $(document).ready(function () {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            })
            $('#cargo').change(function () {
                var e = ($(this).find("option:selected").val());
                input = jQuery('<input type="text" class="form-control" name="cargo" id="cargo" required>');
                if (e == 1) {
                    $("#cargo").remove();
                    $("#input-text-cargo").append(input);
                    alert("Insira um novo cargo");
                    $("#cargo").focus();
                }
            });

        });
    </script>
</head>
<body>
    <div class="header-title" align="center">    
        <h3>Assinaturas</h3>
    </div>
    <div class="container">
