<?php

namespace S4mpp\Format;

class Format
{
    public static function clean($value = null): ?string
    {
        if ($value === null) {
            return null;
        }
    
        return preg_replace('/[.\-\/() ]/', '', $value);
    }

    public static function cpfCnpj($number = null, bool $obscure = false): ?string
    {
        if (is_null($number)) {
            return null;
        }
    
        $total_str = strlen($number);
    
        if ($total_str == 11) {
            $formattedNumber = vsprintf('%s%s%s.%s%s%s.%s%s%s-%s%s', str_split($number));
            
            if ($obscure) {
                $formattedNumber = substr_replace($formattedNumber, '***', 4, 3);
                $formattedNumber = substr_replace($formattedNumber, '***', 8, 3);
            }
            
            return $formattedNumber;
        }
    
        if ($total_str == 14) {
            $formattedNumber = vsprintf('%s%s.%s%s%s.%s%s%s/%s%s%s%s-%s%s', str_split($number));
            
            if ($obscure) {
                $formattedNumber = substr_replace($formattedNumber, '***', 3, 3);
                $formattedNumber = substr_replace($formattedNumber, '***', 7, 3);
                $formattedNumber = substr_replace($formattedNumber, '****', 11, 4);
            }
            
            return $formattedNumber;
        }
    
        return $number;
    }

    public static function cep($cep = null): ?string
    {
        if (is_null($cep) || !is_numeric($cep) || strlen($cep) !== 8) {
            return $cep;
        }
    
        $formattedCep = sprintf('%s%s.%s%s%s-%s%s%s', ...str_split($cep));
    
        return $formattedCep;
    }

    public static function currency(float $value = null, bool $convert_cents = true): ?string
    {
        if($convert_cents)
        {
            $value /= 100;
        }

        return number_format($value, 2, ',', '.');
    }

    public static function decimal(float $value = null, int $decimals = 2): ?string
    {
        return number_format($value, $decimals, ',', '.');
    }

    public static function removeAccents($word = null): ?string
    {
        $search  = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ');
	    
        $replace = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y');

        return str_replace($search, $replace, $word);
    }

    public static function numberToFloat($value = null)
    {
        if (is_null($value)) {
            return null;
        }
    
        $cleanedValue = preg_replace('/[^0-9]/', '', $value);
    
        // $floatValue = str_replace(',', '.', $cleanedValue);
    
        return ($cleanedValue / 100);
    }
}
