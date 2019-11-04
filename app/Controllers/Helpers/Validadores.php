<?php
namespace App\Controllers\Helpers;

use DateTime;


class Validadores {
    const TYPE_STRING = 1;
    const TYPE_INTEGER = 2;
    const TYPE_ID = 3;
    const TYPE_ARRAY_ID = 4;
    const TYPE_DATE = 5;
    
    /**
     * Fun��o estatic responsavel por direcionar a valida��o para o validador especifico de acordo com o tipo
     * @param array $postdata
     * @param string $key
     * @param int $type
     * @param int $tamanho
     * @param int $param
     * @param array $constraint
     */
    public static function validar(array $postdata, string $key, int $type, array &$constraint, $tamanho = false, $param = false)
    {
        switch ($type) {
            case self::TYPE_STRING: 
                self::ValidarString($postdata[$key], $tamanho, $constraint);
                break;
            case self::TYPE_INTEGER:
                self::ValidarInteger($postdata[$key], $tamanho, $constraint);
                break;
            case self::TYPE_ID:
                self::ValidarID($postdata[$key], $constraint);
                break;
            case self::TYPE_ARRAY_ID:
                self::ValidarArrayID($postdata[$key], $constraint);
                break;
            case self::TYPE_DATE:
                self::ValidarDate($postdata[$key], $param, $constraint);
                break;
            default:
                break;
        }
    }
    
    /**
     * Fun��o responsavel por validar string
     * @param string $value
     * @param string $key
     * @param array $constraint
     */
    private function ValidarString(string $value, int $tamanho, array &$constraint)
    {
        if(strlen($value) > $tamanho) $constraint[] = 'Tamanho muito grande. Tamanho maximo: '. $tamanho.' caracteres';
    }
    
    /**ctype_digit
     * Fun��o responsavel por validar inteiro
     * @param int $value
     * @param string $key
     */
    private function ValidarInteger(int $value, int $tamanho,  array &$constraint)
    {
        if($value > $tamanho) $constraint[] = 'Tamanho muito grande. Tamanho maximo: '. $tamanho;
    }
    
    /**
     * Fun��o responsavel por validar ID
     * @param int $value
     * @param string $key
     */
    private function ValidarID(int $value, array &$constraint)
    {
        if(ctype_digit($value)) $constraint[] = 'ID invalida -  '. $value;
    }
    
    /**
     * Fun��o responsavel por validar IDs
     * @param array $value
     * @param string $key
     */
    private function ValidarArrayID(array $value, array &$constraint)
    {
        foreach($value as $key){
            self::ValidarID($key, $constraint);
        }
    }
    
    /**
     * Fun��o responsavel por validar Data
     * @param date $value
     * @param string $format
     */
    private function ValidarDate($value, $format = 'Y-m-d H:i:s', array &$constraint)
    {
        $d = DateTime::createFromFormat($format, $value);
        if($d && $d->format($format) == $value) return;
        
        $constraint[] = 'Data invalida - ' . $value;
    }
}