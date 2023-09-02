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
        if (is_null($word)) {
            return null;
        }
    
        return iconv('UTF-8', 'ASCII//TRANSLIT', $word);
    }

    public static function numberToFloat($value = null)
    {
        if (is_null($value)) {
            return null;
        }
    
        $cleanedValue = preg_replace('/[^0-9]/', '', $value);
        
        return ($cleanedValue / 100);
    }
}
