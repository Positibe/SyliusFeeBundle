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
use Sylius\Component\Product\Model\ProductVariantInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Fee
 * @package Positibe\Sylius\FeePlugin\Entity
 *
 * @ORM\Table("sylius_fee")
 * @ORM\Entity(repositoryClass="Positibe\Sylius\ProductBundlesPlugin\Repository\BundledProductRepository")
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class Fee implements FeeInterface, ResourceInterface
{
    use TimestampableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=TRUE)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=TRUE)
     */
    protected $helpDescription;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $amount;

    /**
     * @var boolean
     *
     * The fee is included or not in the price
     *
     * @ORM\Column(type="boolean")
     */
    protected $includedInPrice = false;

    /**
     * @var bool
     *
     * It could be flat number or percent
     *
     * @ORM\Column(type="boolean")
     */
    protected $percent = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $multiplied = false;

    /**
     * @var ProductInterface
     *
     * @ORM\ManyToOne(targetEntity="Sylius\Component\Product\Model\ProductInterface", inversedBy="fees")
     */
    protected $product;

    /**
     * @var ProductVariantInterface
     *
     * @ORM\ManyToOne(targetEntity="Sylius\Component\Product\Model\ProductVariantInterface", inversedBy="fees")
     */
    protected $variant;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return bool
     */
    public function isIncludedInPrice(): bool
    {
        return $this->includedInPrice;
    }

    /**
     * @param bool $includedInPrice
     */
    public function setIncludedInPrice(?bool $includedInPrice)
    {
        $this->includedInPrice = $includedInPrice;
    }

    /**
     * @return bool
     */
    public function isPercent(): bool
    {
        return $this->percent;
    }

    /**
     * @param bool $percent
     */
    public function setPercent(?bool $percent)
    {
        $this->percent = $percent;
    }

    /**
     * @return bool
     */
    public function isMultiplied(): bool
    {
        return $this->multiplied;
    }

    /**
     * @param bool $multiplied
     */
    public function setMultiplied(?bool $multiplied)
    {
        $this->multiplied = $multiplied;
    }

    /**
     * @return ProductInterface|null
     */
    public function getProduct(): ?ProductInterface
    {
        return $this->product;
    }

    /**
     * @param ProductInterface|null $product
     */
    public function setProduct(?ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * @return ProductVariantInterface
     */
    public function getVariant(): ?ProductVariantInterface
    {
        return $this->variant;
    }

    /**
     * @param ProductVariantInterface $variant
     */
    public function setVariant(?ProductVariantInterface $variant)
    {
        $this->variant = $variant;
    }

    /**
     * @return string
     */
    public function getHelpDescription(): ?string
    {
        return $this->helpDescription;
    }

    /**
     * @param string $helpDescription
     */
    public function setHelpDescription(?string $helpDescription)
    {
        $this->helpDescription = $helpDescription;
    }

    public function getLabel(): ?string
    {
        return sprintf(
            '%s (%s)',
            $this->name,
            $this->isPercent() ? ($this->getAmount() / 100).'%' : ('$'.number_format($this->getAmount() / 100, 2))
        );
    }
}