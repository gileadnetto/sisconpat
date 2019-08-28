<?php

namespace lib\Template;
class Template {
    protected $file;
    protected $values = array();
 
    public function __construct($file) {
        $this->file = $file;
    }

    public function set($key, $value) {
        $this->values[$key] = $value;
    }
     
    /**
     * Funcao que irar trocar as tags {} do arquivo template pelo parametros enviados e retornarar a string html
     */
    public function processar() {
        if (!file_exists($this->file)) {
            return "Erro ao carregar arquivo do template ($this->file).<br />";
        }
        $output = file_get_contents($this->file);
     
        foreach ($this->values as $key => $value) {
            $tagToReplace = '{'.$key.'}';
            $output = str_replace($tagToReplace, $value, $output);
        }
     
        return $output;
    }
}