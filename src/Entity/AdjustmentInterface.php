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

use Sylius\Component\Core\Model\AdjustmentInterface as BaseAdjustmentInterface;

/**
 * Interface AdjustmentInterface
 * @package Positibe\Sylius\FeePlugin\Entity
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface AdjustmentInterface extends BaseAdjustmentInterface
{
    public const FEE_ADJUSTMENT = 'fee_adjustment';
}