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
 * Trait OrderItemFeeableTrait
 * @package Positibe\Sylius\FeePlugin\Entity
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
trait OrderItemFeeableTrait
{
    /**
     * {@inheritdoc}
     */
    public function getFeeTotal(): int
    {
        $feeTotal = 0;

        /** @var AdjustmentInterface $feeAdjustment */
        foreach ($this->getAdjustments(AdjustmentInterface::FEE_ADJUSTMENT) as $feeAdjustment) {
            $feeTotal += $feeAdjustment->getAmount();
        }

        return $feeTotal;
    }
}