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

namespace Positibe\Sylius\FeePlugin\OrderProcessor;

use Positibe\Sylius\FeePlugin\Calculator\CalculatorInterface;
use Positibe\Sylius\FeePlugin\Entity\AdjustmentInterface;
use Positibe\Sylius\FeePlugin\Entity\FeeableInterface;
use Positibe\Sylius\FeePlugin\Entity\FeeInterface;
use Sylius\Component\Order\Factory\AdjustmentFactoryInterface;
use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Order\Model\OrderItemInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;


/**
 * Class FeeProcessor
 * @package Positibe\Sylius\FeePlugin\OrderProcessor
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class FeeOrderProcessor implements OrderProcessorInterface
{
    protected $adjustmentFactory;
    protected $feeCalculator;

    public function __construct(AdjustmentFactoryInterface $adjustmentFactory, CalculatorInterface $feeCalculator)
    {
        $this->adjustmentFactory = $adjustmentFactory;
        $this->feeCalculator = $feeCalculator;
    }

    /**
     * @param OrderInterface|\Sylius\Component\Core\Model\OrderInterface $order
     * @throws \Exception
     */
    public function process(OrderInterface $order): void
    {
        foreach ($order->getItems() as $item) {
            /** @var FeeableInterface $product */
            $product = $item->getVariant()->getProduct();

            $item->removeAdjustmentsRecursively(AdjustmentInterface::FEE_ADJUSTMENT);
            foreach ($product->getFees() as $fee) {
                $this->apply($fee, $item);

            }
        }
    }

    public function apply(FeeInterface $fee, OrderItemInterface $orderItem)
    {
        $multiply = $fee->isMultiplied() ? $orderItem->getUnits()->count() : 1;
        $amount = $this->feeCalculator->calculate($fee, $orderItem->getUnitPrice(), $multiply);
        $adjustment = $this->adjustmentFactory->createWithData(
            AdjustmentInterface::FEE_ADJUSTMENT,
            $fee->getLabel().($multiply > 1 ? (" x ".$multiply) : ''),
            (int)$amount,
            $fee->isIncludedInPrice()
        );

        $orderItem->addAdjustment($adjustment);
    }
}