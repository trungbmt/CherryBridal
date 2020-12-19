<?php
namespace App\Libraries;

class Tools {

	public static function price_format($arg) {
        return number_format($arg, 0, ',', '.').'đ';
    }
}