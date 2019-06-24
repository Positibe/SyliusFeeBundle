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

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface HasFeeInterface
 * @package Positibe\Sylius\FeePlugin\Entity
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface FeeableInterface
{
    /**
     * @return FeeInterface[]|ArrayCollection
     */
    public function getFees();


    /**
     * @param ArrayCollection|FeeInterface[] $fees
     */
    public function setFees($fees);

    /**
     * @param FeeInterface $fee
     * @return $this
     */
    public function addFee($fee);

    /**
     * @param $fee
     * @return $this
     */
    public function removeFee($fee);
}