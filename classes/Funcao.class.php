<?php
    include_once('Database.class.php');
    global $db;
    $db = new Database();

    class Funcao 
    {
        public function validar_telefone($numero)
        {
            if ($numero == "") return TRUE;

            $regex = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/';
            $ret = preg_match($regex, $numero);
    	    if($ret === 1)
    	    {
                return TRUE;
    	    }
    	    else
    	    {
                return FALSE;
    	    }
        }

        public function validar_email($email)
        {
            if ($email == "") return TRUE;

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }

        /**
         * Função que obtém/cria o nome do arquivo da imagem
         * 
         */
        public function obter_arquivo($nome, $empresa)
        {
            if ($empresa == 'Rede Cred Auto') $empresa = 'RCA';
            
            $arquivo = Assinatura::removeAcento("$nome-$empresa");
            $arquivo = strtolower($arquivo);
            $arquivo = trim($arquivo);
            $arquivo = str_replace(' ', '_', $arquivo);

            return "$arquivo.jpg";
        }

        /**
         * Função que converte uma imagem com formato jpeg para Base64
         * 
         */
        private function jpegToBase64($imagem) {

            ob_start();
        
            imagejpeg($imagem, NULL, 50);
       
            $base64 = ob_get_clean();
            $base64 = base64_encode($base64);
            return "data:image/jpeg;base64,$base64";
        }

    }