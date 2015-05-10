<?php

require_once("./class/Pessoa.class.php");
require_once("./class/ItemValue.class.php");

class Participante {
    private $pessoas;
    private $estados;
    private $cidades;//vetor de pessoas.

    /* método construtor
     * inicializa propriedades
     */

    function __construct() {
        $this->pessoas = array();
        $this->estados = array();
        $this->cidades = array();
    }

    function addPessoa(Pessoa $p) {
        array_push($this->pessoas, $p);
    }
    
    function addEstados(ItemValue $p)
    {
       array_push($this->estados, $p);  
    }
    
    function addCidades(ItemValue $p)
    {
       array_push($this->cidades, $p);  
    }

    function mostrar_() {
        foreach ($this->pessoas as $pessoa) {
            $pessoa->mostraDados();
        }
    }

    function exibeDados() {
        if (!empty($this->pessoas)) {
            foreach ($this->pessoas as $pessoa) {
                echo"<div class=\"col-xs-6 col-md-3\">\n";
                echo"   <a href=\"./authPessoa.php?id=" . $pessoa->getLogin() . "\">\n";
                echo"   <figure>\n";
                echo"     <img src=\"" . $pessoa->getFoto() . "\" alt=\"" . $pessoa->getNome() . "\">\n";
                echo"     <figcaption>" . $pessoa->getNome() . "<br/>" . $pessoa->getCidade() . " - " . $pessoa->getEstado() . "</figcaption>\n";
                echo"   </figure>\n";
                echo"   </a>\n";
                echo"</div>\n";
            }
        } else {
            echo'<div>';
            echo"\n<h3 class=\sub-header\>Nenhum contato encontrado. " . count($this->pessoas) . " registros</h3>";
            echo'</div>';
        }
    }

    function exibeEstados($selected)
    {
         if (!empty($this->estados)) {
            foreach ($this->estados as $estado) {
                if ($selected == $estado->getId()) {
                    echo "<option selected value=" . utf8_encode($estado->getId()) . ">" . utf8_encode($estado->getValue()) . "</option>";
                } else {
                    echo "<option value=" . utf8_encode($estado->getId()) . ">" . utf8_encode($estado->getValue()) . "</option>";
                }
            }
         }
    }
    
    function exibeCidades($selected)
    {
         if (!empty($this->cidades)) {
            foreach ($this->cidades as $cidade) {
                if ($selected == $cidade->getId()) {
                    echo "<option selected value=" . utf8_encode($cidade->getId()).">".utf8_encode($cidade->getDescription())."</option>";
                } else {
                    echo "<option value=" . utf8_encode($cidade->getId()) . ">" . utf8_encode($cidade->getDescription()) . "</option>";
                }
            }
        }
    }

}

?>