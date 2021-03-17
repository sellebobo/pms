<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Remuneration;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if (isset($options['type_form']) && !empty($options['type_form']) && $options['type_form'] == 'form_with_password') {
            $builder
                ->add('password', PasswordType::class, [
                    'label' => 'Mot de passe',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Choisissez un bon mot de passe !',
                    ],
                ])
                ->add('passwordConfirm', PasswordType::class, [
                    'label' => 'Confirmation de mot de passe',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Veuillez confirmer votre mot de passe',
                    ],
                ]);
        }

        $builder
            ->add('login', TextType::class, [
                'label' => 'Login',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Saisir le login',
                ],
            ])

            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom',
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prenom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Prenom',
                ],
            ])
            ->add('genre', ChoiceType::class, [
                'label' => 'Genre',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Genre',
                ],
                'choices' => [
                    'HOMME' => 'HOMME',
                    'FEMME' => 'FEMME',
                ],
            ])
            ->add('dateNaiss', DateType::class, [
                'label' => 'Date de naissance',
                'required' => true,
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('lieuNaiss', TextType::class, [
                'label' => 'Lieu de naissance',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Lieu de Naissance',
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Adresse',
                ],
            ])
            ->add('telephone', IntegerType::class, [
                'label' => 'Telephone',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Telephone',
                ],
            ])
            ->add('SM', ChoiceType::class, [
                'label' => 'Situation Matrimoniale',
                'required' => false,
                'choices' => [
                    'MARIE' => 'MARIE',
                    'CELIBATAIRE' => 'CELIBATAIRE',
                    'VEUF' => 'VEUF',
                    'DIVORCE' => 'DIVORCE',
                ],
                'attr' => [
                    'label' => "situation matrimoniale",
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Email',
                ],
            ])
            ->add('activite', TextType::class, [
                'label' => 'Activité',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Activité',
                ],
            ])
            ->add('nationality', ChoiceType::class, [
                'label' => 'Nationalité',
                'required' => false,
                'choices' => [
                    'sénégalaise' => 'sénégalaise',
                ],
            ])
            ->add('typePieceIdentity', ChoiceType::class, [
                'label' => "Type de pièce d'identité",
                'required' => false,
                'choices' => [
                    'CNI' => 'CNI',
                    'PASSEPORT' => 'PASSEPORT',
                    'PERMIT' => 'PERMIT',
                ],
                'attr' => [
                    'placeholder' => "Type de Piéce d'identification",
                ],
            ])
            ->add('numeroPieceIdentity', TextType::class, [
                'label' => "Numero de pièce d'identité",
                'required' => false,
                'attr' => [
                    'placeholder' => "saisir son sumero de piéce d'identification",
                ],
            ])
            ->add('profession', TextType::class, [
                'label' => "Profession",
                'required' => false,
                'attr' => [
                    'placeholder' => 'son profession',
                ],
            ])
            ->add('dateDelivrance', DateType::class, [
                'label' => "Date de Delivrance",
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('servicePlugAt', DateType::class, [
                'label' => "Date de Prise de Service",
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('endOfContractAt', DateType::class, [
                'label' => "Date de Fin de contrat",
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('signedContratAt', DateType::class, [
                'label' => "Date de signature de contrat",
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('tailleFamille', IntegerType::class, [
                'label' => "Taile de la famille",
                'required' => false,
                'attr' => [
                    'placeholder' => 'indiquer la taille de la famille',
                ],
            ])
            ->add('userRoles', null, [
                'class' => Role::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->findVisibleQuery();
                },
                'label' => 'fonction',
                'placeholder' => 'choisir',
                'attr' => [
                    'style' => "width: 100%",
                    'class' => 'select2',
                    'multiple' => false,
                ],
            ])

            ->add('otherContactFullName', TextType::class, [
                'label' => "Personne a contacter en cas d'urgence",
                'required' => false,
                'attr' => [
                    'placeholder' => 'Saisir son nom Complet',
                ],
            ])
            ->add('otherContactPhone', IntegerType::class, [
                'label' => "Telephone personne a contacter en cas d'urgence",
                'required' => false,
                'attr' => [
                    'placeholder' => 'Saisir son nom Complet',
                ],
            ])
            ->add('insuranceEligibleAt', DateType::class, [
                'label' => "Date d'admissibilite assurance collective",
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('otherContactParentalBond', ChoiceType::class, [
                'label' => "Lien de parenté autre contact",
                'required' => false,
                'choices' => [
                    'PERE' => 'PERE',
                    'MERE' => 'MERE',
                    'FRERE' => 'FRERE',
                    'SOEUR' => 'SOEUR',
                    'ONCLE ' => 'ONCLE',
                    'TANTE' => 'TANTE',
                    'GRAND MERE' => 'GRAND MERE',
                    'GRAND PERE' => 'GRAND PERE',
                    'COUSIN(E)' => 'COUSIN(E)',
                ],
                'attr' => [
                    'placeholder' => "Type de Piéce d'identification",
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'type_form' => '',
        ]);
    }
}
