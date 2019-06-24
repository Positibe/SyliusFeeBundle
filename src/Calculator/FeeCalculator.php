<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Positibe\Sylius\FeePlugin\Calculator;

use Positibe\Sylius\FeePlugin\Entity\FeeInterface;


/**
 * Class FeeCalculator
 * @package Positibe\Sylius\FeePlugin\Calculator
 *
 * Calculate the fee of a base price
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class FeeCalculator implements CalculatorInterface
{
    public function calculate(FeeInterface $fee, int $base, int $multiply = 1): int
    {
        $amount = $fee->getAmount();

        if ($fee->isPercent()) {
            $amount = $amount === 10000 ? $base : $base / (10000 - $amount);
        }
        if ($fee->isMultiplied()) {
            $amount *= $multiply;
        }

        return (int)round($amount);
    }
}