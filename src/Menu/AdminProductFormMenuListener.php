<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Sylius\FeePlugin\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;
use Sylius\Bundle\AdminBundle\Menu\ProductFormMenuBuilder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


/**
 * Class AdminProductFormMenuListener
 * @package Positibe\Sylius\FeePlugin\Menu
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class AdminProductFormMenuListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [ProductFormMenuBuilder::EVENT_NAME => "addFeeTab"];
    }

    public function addFeeTab(ProductMenuBuilderEvent $event)
    {
        $menu = $event->getMenu();

        $menu
            ->addChild('product_fees')
            ->setAttribute('template', '@SyliusFeePlugin/Product/Tab/_fee.html.twig')
            ->setLabel('sylius.ui.fees')
        ;
    }
}