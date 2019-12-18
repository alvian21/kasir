<?php
namespace App\CustomClass;

class hitung
{
    var $a;
    var $b;
    var $c;

     function cekoperasi($data)
     {
        switch($data)
        {
            case 'hitung':
            return $this->a * $this->b;

        }
     }

     function result($a, $b, $c)
     {
         $this->a = $a;
         $this->b = $b;
         return $this->cekoperasi($c);

     }
}
