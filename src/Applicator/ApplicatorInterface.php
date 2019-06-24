<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Sylius\FeePlugin\Applicator;


/**
 * Class ApplicatorInterface
 * @package Positibe\Sylius\FeePlugin\Applicator
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface ApplicatorInterface
{
    public function apply();
}