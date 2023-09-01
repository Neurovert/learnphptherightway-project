<?php
declare(strict_types=1);

function amountFormat(float $amount): string
{
    $amountAbsolute = abs($amount);
    return ($amount < 0) ? "-$" . $amountAbsolute : "$" . $amountAbsolute;
}
