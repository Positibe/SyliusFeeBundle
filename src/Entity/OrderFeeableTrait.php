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

use Sylius\Component\Order\Model\OrderItem;


/**
 * Class OrderFeeableTrait
 * @package Positibe\Sylius\FeePlugin\Entity
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
trait OrderFeeableTrait
{
    /**
     * {@inheritdoc}
     */
    public function getOrderFeeTotalList(): array
    {
        $adjustments = [];

        /** @var OrderItem $item */
        foreach ($this->items as $item) {
            $adjustments = array_merge(
                $adjustments,
                $item->getAdjustmentsRecursively(AdjustmentInterface::FEE_ADJUSTMENT)->toArray()
            );
        }

        return $adjustments;
    }

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

        /** @var OrderItem|\Sylius\Component\Core\Model\OrderItem|OrderItemFeeableInterface $item */
        foreach ($this->items as $item) {
            $feeTotal += $item->getFeeTotal();
        }

        return $feeTotal;
    }
}