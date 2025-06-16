<?php

    namespace App\Utils;

    use App\Db\Db;

    class Helpers {
        
        public static function addQuotes(string $text): string {
            return "'" . $text . "'";
        }

        public static function getArrayKeysValues(array $data, string $type = "key"): string
        {
            if ($type === "key") {
                return implode(', ', array_keys($data));
            }
            return implode(', ', array_values($data));
        }

        public static function realFormat(float $amount, $currency = false): float {
            if($currency) {
            return "R$ " .  number_format($amount, 2, ",", ".");

            }
            return number_format($amount, 2, ",", ".");
        } 

        public static function decimalFormat(string $amount): float {
            return filter_var($amount, FILTER_VALIDATE_FLOAT);
        } 

        public static function intFormat(string $amount): int {
            return filter_var($amount, FILTER_VALIDATE_INT);
        } 

    }