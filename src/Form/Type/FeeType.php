<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Sylius\FeePlugin\Form\Type;


use Positibe\Sylius\FeePlugin\Entity\FeeInterface;
use Positibe\Sylius\FeePlugin\Form\DataTransformer\MoneyPercentViewTransformer;
use Sylius\Bundle\MoneyBundle\Form\DataTransformer\SyliusMoneyTransformer;
use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\MoneyToLocalizedStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FeeType
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class FeeType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                ['label' => 'positibe_fee_plugin.ui.name']
            )
            ->add(
                'percent',
                ChoiceType::class,
                [
                    'label' => 'positibe_fee_plugin.ui.amount_type',
                    'choices' => [
                        'positibe_fee_plugin.ui.flat_number' => false,
                        'positibe_fee_plugin.ui.percent' => true,
                    ],
                ]
            )
            ->add(
                'amount',
                NumberType::class,
                ['label' => 'positibe_fee_plugin.ui.amount']
            )
            ->add(
                'multiplied',
                CheckboxType::class,
                ['label' => 'positibe_fee_plugin.ui.multiplied']
            )
            ->add(
                'includedInPrice',
                CheckboxType::class,
                ['label' => 'positibe_fee_plugin.ui.included_in_price']
            )
            ->add(
                'helpDescription',
                TextType::class,
                ['label' => 'positibe_fee_plugin.ui.help_description', 'required' => false]
            );

        $builder->get('amount')
            ->resetViewTransformers()
            ->addViewTransformer(
                new MoneyToLocalizedStringTransformer(
                    2,
                    false,
                    null,
                    100
                )
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Positibe\Sylius\FeePlugin\Entity\Fee',
            )
        );
    }
}