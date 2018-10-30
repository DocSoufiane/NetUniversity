<?php

namespace NetUniversity\PlatformBundle\Form;

//use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
//use NetUniversity\PlatformBundle\Form\LocalisationType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
//use Symfony\Component\Form\Extension\Core\Type\Datetime;
//use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class ModifUtilisateurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenom',     TextType::class)
            ->add('nom',     TextType::class)
            ->add('username',   EmailType::class)
            ->add('email',   EmailType::class)
            ->add('age',    NumberType::class)
            ->add('localisation', EntityType::class, array(
                'class'        => 'NetUniversityPlatformBundle:Localisation',
                'choice_label' => 'nom',
                'multiple'     => false,
              ))
            ->add('university', EntityType::class, array(
                'class'        => 'NetUniversityPlatformBundle:University',
                'choice_label' => 'name',
                'multiple'     => false,
              ))
          ->add('save',      SubmitType::class);


       // ->add('nom')->add('prenom')->add('mail')->add('passe')->add('dateDinscription')->add('type')->add('age')->add('dernierevisite')->add('save',      SubmitType::class)->add('localisation', LocalisationType::class);// Ajoutez cette ligne
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NetUniversity\PlatformBundle\Entity\Utilisateur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'netuniversity_platformbundle_utilisateur';
    }


}
