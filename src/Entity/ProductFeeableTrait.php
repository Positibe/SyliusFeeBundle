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
use Doctrine\ORM\Mapping as ORM;


/**
 * Class FeeableTrait
 * @package Positibe\Sylius\FeePlugin\Entity
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
trait ProductFeeableTrait
{
    /**
     * @var FeeInterface[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Positibe\Sylius\FeePlugin\Entity\Fee", mappedBy="product", cascade={"persist", "remove"})
     */
    protected $fees;

    /**
     * @return ArrayCollection|FeeInterface[]
     */
    public function getFees()
    {
        return $this->fees;
    }

    /**
     * @param ArrayCollection|FeeInterface[] $fees
     */
    public function setFees($fees)
    {
        $this->fees = $fees;
    }

    /**
     * @param FeeInterface $fee
     * @return $this
     */
    public function addFee($fee)
    {
        $fee->setProduct($this);
        $this->fees->add($fee);

        return $this;
    }

    /**
     * @param $fee
     * @return $this
     */
    public function removeFee($fee)
    {
        $this->fees->removeElement($fee);

        return $this;
    }
}