<?php

namespace App\Form;

use App\Entity\Ad;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{


    /**
     * Une fonction qui retoure un array de configuration twig
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder)
    {

        return ["label" => $label,  "attr" => [
            "placeholder" => $placeholder,
        ]];
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('title', TypeTextType::class, $this->getConfiguration("Titre", "Entrer le titre de l'article"))
            ->add('slug', TypeTextType::class, $this->getConfiguration("Lien de la page", "Lien de la page(auto)"))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix", "Entrer le prix de l'article"))
            ->add('introduction', TypeTextType::class, $this->getConfiguration("Introduction", "Donner une introduction général à l'annonce"))

            ->add('coverImage', UrlType::class, $this->getConfiguration("Url de de l'image principal", "Entrer l'url d'une image de votre bien"))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de champbres", "Entrer le nombre de chambre de votre bien"))
            ->add('content', null, $this->getConfiguration("Description", "Donner une description pour votre bien"))
            ->add("images", CollectionType::class, ["entry_type" => ImageType::class]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}