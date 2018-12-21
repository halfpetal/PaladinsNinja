<?php

namespace PaladinsNinja\Enum;

use MyCLabs\Enum\Enum;

class ChampionRole extends Enum
{
    public const SUPPORT = 'support';
    public const DAMAGE = 'damage';
    public const FRONTLINE = 'frontline';
    public const FLANK = 'flank';
    

    public static function getChampionRole(int $championId)
    {
        switch ($championId) {
            case 2281:
            case 2092:
            case 2495:
            case 2277:
            case 2249:
            case 2417:
            case 2307:
            case 2438:
            case 2314:
            case 2285:
            case 2480:
            case 2393:
                return self::DAMAGE;
            case 2205:
            case 2147:
            case 2094:
            case 2493:
            case 2362:
            case 2338:
            case 2481:
            case 2057:
            case 2472:
            case 2420:
                return self::FLANK;
            case 2404:
            case 2073:
            case 2071:
            case 2348:
            case 2479:
            case 2288:
            case 2149:
            case 2477:
            case 2322:
                return self::FRONTLINE;
            case 2491:
            case 2093:
            case 2254:
            case 2431:
            case 2303:
            case 2056:
            case 2372:
            case 2267:
                return self::SUPPORT;
        }
    }
}