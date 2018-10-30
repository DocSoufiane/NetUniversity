<?php

namespace NetUniversity\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\University;
use NetUniversity\PlatformBundle\Entity\Institut;


class InstitutType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',     TextType::class)
                ->add('file', FileType::class)
                ->add('localisation', EntityType::class, array(
                'class'        => 'NetUniversityPlatformBundle:Localisation',
                'choice_label' => 'nom',
                'multiple'     => false,
              ))
               /* ->add('university', EntityType::class, array(
                'class'        => 'NetUniversityPlatformBundle:University',
                'choices'      => $this->User()->getUniversity(),
                'choice_label' => 'Name',
                'multiple'     => false,
              )) */
          ->add('save',      SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NetUniversity\PlatformBundle\Entity\Institut'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'netuniversity_platformbundle_institut';
    }


}
