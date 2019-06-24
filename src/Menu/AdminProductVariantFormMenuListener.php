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


namespace Positibe\Sylius\FeePlugin\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductVariantMenuBuilderEvent;
use Sylius\Bundle\AdminBundle\Menu\ProductVariantFormMenuBuilder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


/**
 * Class AdminProductVariantFormMenuListener
 * @package Positibe\Sylius\FeePlugin\Menu
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class AdminProductVariantFormMenuListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [ProductVariantFormMenuBuilder::EVENT_NAME => 'addFeeTab'];
    }

    public function addFeeTab(ProductVariantMenuBuilderEvent $event)
    {
        $menu = $event->getMenu();

        $menu
            ->addChild('variant_fees')
            ->setAttribute('template', '@SyliusFeePlugin/ProductVariant/Tab/_fee.html.twig')
            ->setLabel('sylius.ui.fees');
    }

}