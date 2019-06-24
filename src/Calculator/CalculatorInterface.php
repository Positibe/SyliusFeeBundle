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
 * Interface CalculatorInterface
 * @package Positibe\Sylius\FeePlugin\Calculator
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface CalculatorInterface
{
    public function calculate(FeeInterface $fee, int $base, int $multiply = 1): int;
}