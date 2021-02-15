<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\Image;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $fakar = Factory::create('fr-FR');
        for ($i = 1; $i <= 10; $i++) {
            $ad = new Ad();
            $title = $fakar->sentence();

            $introduction = $fakar->paragraph(2);
            for ($j = 1; $j <= mt_rand(3, 5); $j++) {
                $image = new Image();
                $image->setAd($ad)->setCaption($fakar->sentence())->setUrl("https://picsum.photos/600/450");
                $manager->persist($image);
            }

            $ad->setTitle($title)
                ->setContent('<p>' . join("</p><p>", $fakar->paragraphs()) . '</p>')
                ->setCoverImage("http://placehold.it/1000x400")
                ->setPrice(mt_rand(30, 100))

                ->setRooms(mt_rand(1, 5))
                ->setIntroduction($introduction);
            $manager->persist($ad);
        }

        // $product = new Product();
        // 

        $manager->flush();
    }
}