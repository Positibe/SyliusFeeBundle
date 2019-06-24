<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Sylius\FeePlugin\Entity;

use Sylius\Component\Product\Model\ProductInterface;


/**
 * Interface FeeInterface
 * @package Positibe\Sylius\FeePlugin\Entity
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface FeeInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return int
     */
    public function getAmount();

    /**
     * @param int $fee
     */
    public function setAmount(int $fee);

    /**
     * @return bool
     */
    public function isIncludedInPrice(): bool;

    /**
     * @param bool $includedInPrice
     */
    public function setIncludedInPrice(?bool $includedInPrice);

    /**
     * @return bool
     */
    public function isPercent();

    /**
     * @param bool $percent
     */
    public function setPercent(?bool $percent);

    /**
     * @return bool
     */
    public function isMultiplied();

    /**
     * @param bool $multiplied
     */
    public function setMultiplied(?bool $multiplied);

    /**
     * @return string
     */
    public function getHelpDescription(): ?string;

    /**
     * @param string $helpDescription
     */
    public function setHelpDescription(?string $helpDescription);

    /**
     * @return ProductInterface|null
     */
    public function getProduct(): ?ProductInterface;

    /**
     * @param ProductInterface|null $product
     */
    public function setProduct(?ProductInterface $product);

    public function getLabel(): ?string;
}