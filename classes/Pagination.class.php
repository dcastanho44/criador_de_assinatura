<?php

class Pagination {
    /**
     * Número máximo de registros por página
     * @var integer
     */
    private $limit;

    /**
     * Quantidade total de resultados por página
     * @var integer
     */
    private $results;
    
    /**
     * Quantidade total de páginas
     * @var integer
     */
    private $pages;

    /**
     * Página atual
     * @var integer
     */
    private $currentpage;

    /**
     * Construtor da Classe
     * @param $results, $currentpage, $limit
     */
    public function __construct($results, $currentpage = 1, $limit = 10){
        $this->results = $results;
        $this->limit = $limit;
        $this->currentpage = (is_numeric($currentpage) && $currentpage > 0) ? $currentpage : 1;
        $this->calculate();
    }

    /**
     * Método responsável por calcular a paginação
     * 
     */
    private function calculate(){
        //calcula o total de páginas
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        //verifica se a página atual não excede o número de páginas
        $this->currentpage = $this->currentpage <= $this->pages ? $this->currentpage : $this->pages;
    }

    /**
     * Método responsável por obter o limit e o offset que serão inseridos na query
     * 
     */
    public function getOffset(){
        $offset = ($this->limit * ($this->currentpage - 1));
        return $offset;
    }

    /**
     * Método responsável por retornar as opções de páginas disponíveis
     * @return array
     */
    public function getPages(){
        //Não retorna páginas
        if($this->pages == 1) return array();

        //Páginas
        $paginas = array();
        for($i = 1; $i <= $this->pages; $i++){
            $paginas[] = array(
                'pagina' => $i,
                'atual' => $i == $this->currentpage
            );
        }
        return $paginas;
    }

}
