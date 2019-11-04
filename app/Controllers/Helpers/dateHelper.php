<?php
namespace App\Controllers\Helpers;

use DateTime;


class dateHelper {
    
    /**
     * Função responsavel por formatar a data
     * @param date $value
     * @param string $format
     */
    public static function dateFormat($value, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $value);
        return $d->format($format);
    }
    
    /**
     * Função responsavel por formatar a data para salvar no bd
     * @param date $value
     */
    public static function dateFormatBD($value)
    {
        $d = DateTime::createFromFormat('d/m/Y', $value);
        return $d->format('Y-m-d');
    }
    
    /**
     * Função responsavel por formatar a data para a view
     * @param date $value
     */
    public static function dateFormatView($value)
    {
        $d = DateTime::createFromFormat('d-m-Y', $value);
        return $d->format('d-m-Y');
    }
}