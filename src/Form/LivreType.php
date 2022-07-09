<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('annee')
            ->add('prix')
            ->add('edition')
            ->add('image' , FileType::class, array(
                'label' => 'Choisisser votre image'
            ))

           // ->add('categorie')
           // ->add('auteur')

          ->add('categorie', EntityType::class, array (
               'class' => 'App\Entity\Categorie',
              'label' => 'Choisir la categorie',
              'choice_label' => 'nom'))
           

          ->add('auteur', EntityType::class, array (
           'class' => 'App\Entity\Auteur',
           'label' => 'Choisir les auteurs',
            'expanded' => true,
           'multiple' => true,
           'choice_label' => 'nom'.'prenom' ))
        
        ;

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
