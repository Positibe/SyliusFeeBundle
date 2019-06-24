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


namespace Positibe\Sylius\FeePlugin\Entity;


/**
 * Interface OrderFeeableInterface
 * @package Positibe\Sylius\FeePlugin\Entity
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface OrderFeeableInterface
{
    /**
     * Returns an array with amount and description of order fee.
     */
    public function getOrderFeeTotalList(): array;

    /**
     * Returns the total fee in the order and its items.
     */
    public function getFeeTotal(): int;

}