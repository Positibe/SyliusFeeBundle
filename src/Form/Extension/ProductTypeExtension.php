<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Sylius\FeePlugin\Form\Extension;

use Positibe\Sylius\FeePlugin\Form\Type\FeeType;
use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;


/**
 * Class ProductTypeExtension
 * @package Positibe\Sylius\ProductBundlesPlugin\Form\Extension
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class ProductTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fees', CollectionType::class, [
                'label' => 'positibe_fee_plugin.ui.fee',
                'entry_type' => FeeType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'button_add_label' => 'sylius.form.option_value.add_value',
                'entry_options' => ['attr' => ['class' => 'ui segment']],
            ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }

}