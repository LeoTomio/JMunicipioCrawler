
<?php

class Municipio {

    private $url;
    private $proxy;
    private $dom;
    private $html;

    public function __construct() {
        $this->url = 'https://omunicipio.com.br/noticia/politica/';
        $this->proxy = '10.1.21.254:3128';
        $this->dom = new DOMDocument();
    }

    private function getContextConexao() {
        $arrayConfig = array(
            'http' => array(
                'proxy' => $this->proxy,
                'request_fulluri' => true
            ),
            'https' => array(
                'proxy' => $this->proxy,
                'request_fulluri' => true
            )
        );
        $context = stream_context_create($arrayConfig);
        return $context;
    }

    private function carregarHtml() {
        $context = $this->getContextConexao();
        $this->html = file_get_contents($this->url, false, $context);

        libxml_use_internal_errors(true);

        $this->dom->loadHTML($this->html);
        libxml_clear_errors();
    }

    public function imprimeTitulo() {
        
        $this->carregarHtml();
        $divsGeral = $this->capturarTagsDivGeral();
        $divsInternas = $this->capturarDivsInternasPageContent($divsGeral);
        $divNoticia = $this->pegandoDivsNoticia($divsInternas);
        $Fimagem = $this->filtrandoImagens($divNoticia);
        $Ftitulo = $this->filtrandoTitulos($divNoticia);
        $imagem = $this->getImagem($Fimagem);
        $noticia = $this->getTitulos($Ftitulo);
        return $noticia;
    }

    public function imprimeImagem() {
        
        $this->carregarHtml();
        $divsGeral = $this->capturarTagsDivGeral();
        $divsInternas = $this->capturarDivsInternasPageContent($divsGeral);
        $divNoticia = $this->pegandoDivsNoticia($divsInternas);
        $Fimagem = $this->filtrandoImagens($divNoticia);
        $imagem = $this->getImagem($Fimagem);
        return $imagem;
    }

    public function imprimeLink() {
        
        $this->carregarHtml();
        $divsGeral = $this->capturarTagsDivGeral();
        $divsInternas = $this->capturarDivsInternasPageContent($divsGeral);
        $divNoticia = $this->pegandoDivsNoticia($divsInternas);
        $Flink = $this->filtrandoLinks($divNoticia);
        $link = $this->getLinks($Flink);
        return $link;
    }

    private function capturarTagsDivGeral() {
        
        $tagsDiv = $this->dom->getElementsByTagName('div');
        return $tagsDiv;
    }

    private function capturarDivsInternasPageContent($divsGeral) {
        
        $divsInternas = null;
        
        
        foreach ($divsGeral as $div) {
            $classeInterna = $div->getAttribute('class');
            if ($classeInterna == 'td-ss-main-content') {
                $divsInternas = $div->getElementsByTagName('div');
            }
        }
        return $divsInternas;
    }
//Filtrando as divs das noticias
    private function pegandoDivsNoticia($divsInternas) {
        
        $divNoti = [];
        
        
        foreach ($divsInternas as $divInterna) {
            $classeInterna = $divInterna->getAttribute('class');
            if ($classeInterna == 'td_module_10 td_module_wrap td-animation-stack custom-module-100') {
                $divNoti[] = $divInterna->getElementsByTagName('div');
            }
        }
        return $divNoti;
    }
    
    //   ----- DADOS PARA FILTRAR -----

//Filtrando Links
    private function filtrandoLinks($divNoti) {
        
        $Flinks = [];

        foreach ($divNoti as $internas) {
            foreach ($internas as $link) {
                $classeInterna = $link->getAttribute('class');

                if ($classeInterna == 'item-details') {
                    $Flinks[] = $link->getElementsByTagName('a');
                }
            }
        }
        return $Flinks;
    }

//Filtrando Titulos
    private function filtrandoTitulos($divNoti) {
        
        $titulo = [];

        foreach ($divNoti as $divInterna) {
            foreach ($divInterna as $texto) {
                $classeInterna = $texto->getAttribute('class');



                if ($classeInterna == 'item-details') {
                    $titulo[] = $texto->getElementsByTagName('h3');
                }
            }
        }
        return $titulo;
    }

//Filtrando Imagens para depois pegar
    private function filtrandoImagens($divNoti) {
        
        $img = [];
                
        foreach ($divNoti as $divInterna) {
            foreach ($divInterna as $imagem) {
                $classeInterna = $imagem->getAttribute('class');

                if ($classeInterna == 'td-module-thumb') {
                    $img[] = $imagem->getElementsByTagName('img');
                }
            }
        }
        return $img;
    }

//   ----- DADOS FILTRADOS -----
    
//Pegando os links depois de filtrar
    private function getLinks($Flinks) {
        
        $link = [];

        foreach ($Flinks as $divInterna) {
            foreach ($divInterna as $div) {
                $link[] = $div->getAttribute('href');
            }
        }
        return $link;
    }
//Capturando o titulo das noticias ja filtrados
    private function getTitulos($titulo) {
        
        $noticia = [];
        
        foreach ($titulo as $divInterna) {
            foreach ($divInterna as $div) {
                $classeInterna = $div->getAttribute('class');

                if ($classeInterna == 'entry-title td-module-title') {
                    $noticia[] = utf8_decode($div->nodeValue);
                }
            }
        }
        return $noticia;
    }
    
//Capturando as imagens filtradas
    private function getImagem($img) {
        
        $imagem = [];
        
        foreach ($img as $imagens) {
            foreach ($imagens as $tag) {
                $imagem[] = $tag->getAttribute('src');
            }
        }
        return $imagem;
    }
}
