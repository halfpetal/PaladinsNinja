<?php

namespace PaladinsNinja\Enum;

use MyCLabs\Enum\Enum;

class Platform extends Enum
{
    public const STEAM      = 'steam';
    public const HIREZ      = 'hirez';
    public const SWITCH     = 'switch';
    public const XBL        = 'xbox';
    public const PSN        = 'psn';
    public const PC         = self::STEAM;
    public const NINTENDO   = self::SWITCH;
    public const PS4        = self::PSN;
}