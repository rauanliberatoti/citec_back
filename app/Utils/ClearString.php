<?php

namespace App\Utils;

class ClearString{
    public function clear(string | null $string ){
        if (is_null($string)) return;
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
    }
}
