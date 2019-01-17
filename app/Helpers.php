<?php

if (!function_exists('apiErrorResponse')) {
    function apiErrorResponse($errors) 
    {
        if (is_string($errors)) {
            $errors = [$errors];
        }

        return response()->json([
            'errors' => $errors
        ]);
    }
}

if (!function_exists('properize')) {
    function properize($string) {
        return $string.'\''.($string[strlen($string) - 1] != 's' ? 's' : '');
    }
}

if (!function_exists('calculate_card_scaling')) {
    function calculate_card_scaling($formula, $points) {
        if (strtolower(substr($formula, 0, 6)) != 'scale=') {
            return 0;
        }

        $formula = substr($formula, 6, strlen($formula));
        
        $baseNumber = explode('|', $formula)[0];
        $scaling = explode('|', $formula)[1];

        if ($points <= 1) {
            return $baseNumber;
        }

        return $points * $scaling;
    }
}

if (!function_exists('delete_all_between')) {
    function delete_all_between($beginning, $end, $string) {
        $beginningPos = strpos($string, $beginning);
        $endPos = strpos($string, $end);
        if ($beginningPos === false || $endPos === false) {
            return $string;
        }

        $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

        return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string)); // recursion to ensure all occurrences are replaced
    }
}

if (!function_exists('get_all_between')) {
    function get_all_between($beginning, $end, $string) {
        $string = ' ' . $string;
    $ini = strpos($string, $beginning);
    if ($ini == 0) return '';
    $ini += strlen($beginning);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
    }
}

if (!function_exists('ranked_tier_display')) {
    function ranked_tier_display(int $tier) {
        switch ($tier) {
            case 1:
                return 'Bronze V';
            case 2:
                return 'Bronze IV';
            case 3:
                return 'Bronze III';
            case 4:
                return 'Bronze II';
            case 5:
                return 'Bronze I';
            case 6:
                return 'Silver V';
            case 7:
                return 'Silver IV';
            case 8:
                return 'Silver III';
            case 9:
                return 'Silver II';
            case 10:
                return 'Silver I';
            case 11:
                return 'Gold V';
            case 12:
                return 'Gold IV';
            case 13:
                return 'Gold III';
            case 14:
                return 'Gold II';
            case 15:
                return 'Gold I';
            case 16:
                return 'Platinum V';
            case 17:
                return 'Platinum IV';
            case 18:
                return 'Platinum III';
            case 19:
                return 'Platinum II';
            case 20:
                return 'Platinum I'; 
            case 21:
                return 'Diamond V';
            case 22:
                return 'Diamond IV';
            case 23:
                return 'Diamond III';
            case 24:
                return 'Diamond II';
            case 25:
                return 'Diamond I';
            case 26:
                return 'Masters I';
            case 27:
                return 'Grandmaster';
            default:
                return 'Qualifying';
        }
    }
}