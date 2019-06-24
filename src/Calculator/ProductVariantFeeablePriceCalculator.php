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

use Positibe\Sylius\FeePlugin\Entity\FeeableInterface;
use Sylius\Component\Core\Calculator\ProductVariantPriceCalculatorInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;


/**
 * Class ProductVariantFeeableCalculator
 * @package Positibe\Sylius\FeePlugin\Calculator
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class ProductVariantFeeablePriceCalculator implements ProductVariantPriceCalculatorInterface
{
    protected $feeCalculator;

    public function __construct(CalculatorInterface $calculator)
    {
        $this->feeCalculator = $calculator;
    }

    /**
     * @param ProductVariantInterface|FeeableInterface $productVariant
     * @param array $context
     * @return int
     */
    public function calculate(ProductVariantInterface $productVariant, array $context): int
    {
        $price = (int)$context['price'] ?? 0;
        $fees = $productVariant->getFees();
        foreach ($fees as $fee) {
            if ($fee->isIncludedInPrice()) {
                $price += $this->feeCalculator->calculate($fee, $context['price']);
            }
        }

        return (int)$price;
    }
}