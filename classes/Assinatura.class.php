<?php	
	include_once('Database.class.php');
	
	class Assinatura {
		private $db;
		
		function __construct() {
		    $this->db = new Database();
		}

		static function resize_image($file, $w, $h, $crop=FALSE) {
		    list($width, $height) = getimagesize($file);
		    $r = $width / $height;
		    if ($crop) {
		        if ($width > $height) {
		            $width = ceil($width-($width*abs($r-$w/$h)));
		        } else {
		            $height = ceil($height-($height*abs($r-$w/$h)));
		        }
		        $newwidth = $w;
		        $newheight = $h;
		    } else {
		        if ($w/$h > $r) {
		            $newwidth = $h*$r;
		            $newheight = $h;
		        } else {
		            $newheight = $w/$r;
		            $newwidth = $w;
		        }
		    }
		    $src = imagecreatefromjpeg($file);
		    $dst = imagecreatetruecolor($newwidth, $newheight);
		    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		    return $dst;
		}

        static function removeAcento($string){
			$replace = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
							
			return strtr( $string, $replace );
		}
		
		/**
		 * Função que cria a assinatura a partir do modelo de assinatura da Rede Cred Auto
		 * 
		 */
        static function criar_imagem($nome = '', $cargo = '', $whatsapp = '', $telefone = '', $telefone2 = ''){
			if($whatsapp && !$telefone) $jpg_image = imagecreatefromjpeg(__DIR__ . '/../assets/images/assinatura2.jpg');	
			if(!$whatsapp && !$telefone) $jpg_image = imagecreatefromjpeg(__DIR__ . '/../assets/images/assinatura.jpg');
			if($whatsapp && $telefone) $jpg_image = imagecreatefromjpeg(__DIR__ . '/../assets/images/assinatura3.jpg');
			if(!$whatsapp && $telefone) $jpg_image = imagecreatefromjpeg(__DIR__ . '/../assets/images/assinatura4.jpg');
			$black = imagecolorallocate($jpg_image, 0, 0, 0);
			$gray = imagecolorallocate($jpg_image, 70, 70, 70);
			$red = imagecolorallocate($jpg_image, 255, 0, 0);
			$font_path = __DIR__ . '/../assets/fonts/product-sans.ttf';
			$font_path_bold = __DIR__ . '/../assets/fonts/product-sans-bold.ttf';
			imagettftext($jpg_image, 30, 0, 266, 68, $black, $font_path, $nome);												
			imagettftext($jpg_image, 18, 0, 266, 108, $black, $font_path, $cargo);												
			if($whatsapp) imagettftext($jpg_image, 14, 0, 303, 201, $black, $font_path, $whatsapp);												
			if($telefone && !$telefone2) imagettftext($jpg_image, 14, 0, 303, 139, $black, $font_path, $telefone);
			if($telefone && $telefone2) {
				$telefone = "$telefone | $telefone2";
				imagettftext($jpg_image, 14, 0, 300, 139, $black, $font_path, $telefone);
			}												
			return $jpg_image;
		}

		public function obterAssinatura($id)
		{
			$query = "SELECT * FROM tb_assinaturas WHERE id = {$id}";
    
    		$this->db->query = $query;
    		$this->db->content = NULL;

    		$rows = ($this->db->select());
			return $rows;
		}
		
		public function excluirAssinatura($id)
		{
    		$query = "DELETE FROM tb_assinaturas WHERE id = ?";
    		$content = array();
    		$content[] = array ($id, 'int');
    		$this->db->query = $query;
    		$this->db->content = $content;
    		$this->db->delete();
		}
    }