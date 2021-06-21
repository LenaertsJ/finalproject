<?php


namespace App\Form;


use App\Entity\Prices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


//Opbouwen van een form voor prijzen zodat deze rechtstreeks in product crud controller kunnen worden aangemaakt.
class PriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //Admin kan netto prijs invullen.
        $builder
            ->add('netto_price', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        //ingevoerde data wordt toegevoegd aan Prices entity.
        $resolver->setDefaults([
            'data_class' => Prices::class,
        ]);
    }

}