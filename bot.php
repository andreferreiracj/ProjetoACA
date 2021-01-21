<?php

require_once "AmUtil.php";

class bot
{

    public $htmlDaPagina;
    public $contadorDeDivs;
    public $tag;


    public function __construct()
    {

    }

    public function devolverHtml($url)
    {
        $this->htmlDaPagina = AmUtil::consumeUrl($url);
        
    }

    public function contarTags()
    {
        $dom = new DOMDocument();
        if ($dom) {
            @$dom->loadHTML($this->htmlDaPagina);
            $this->tag = $dom->getElementsByTagName('p');
            $this->contadorDeDivs = count($this->tag); 
        }
        var_dump($this->contadorDeDivs);
    }


    public function receberTags()
    {
        $dom = new DOMDocument();
        if ($dom)  {
            @$dom->loadHTML($this->htmlDaPagina); 
            $this->tag = $dom->getElementsByTagName('article'); 
            foreach ($this->tag as $tagChave => $tagValor) {
                //var_dump($tagChave);
                //$resposta = $tagValor->childNodes[1]->textContent;
                //var_dump($resposta);
               $resposta = $tagValor->childNodes[1]->childNodes[1]->getAttribute('href');
                return " Ultima noticia: " . $resposta  . "\n";
            }
        }
    }
}

