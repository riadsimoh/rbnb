<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Image;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads")
     */
    public function index(AdRepository $repo): Response
    {


        $ads = $repo->findAll();

        dump($ads);

        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * @Route("/ad/new", name="ad_new")
     * 
     * @return Response
     */

    public function create(Request $request, EntityManagerInterface $manager)
    {


        $ad = new Ad();

        $image = new Image();
        $image->setUrl("http://placehold.it/4000x500")
            ->setCaption("test");
        $ad->addImage($image);

        $form =  $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($ad);
            $manager->flush();



            return $this->redirectToRoute("ad_show", ["slug" => $ad->getSlug()]);
        }



        return $this->render('ad/new.html.twig', ["form" => $form->createView()]);
    }

    /**
     * @Route("/ad/{slug}", name="ad_show")
     *
     * @return void
     */
    public function show(Ad $ad)
    {

        return $this->render("ad/show.html.twig", ['ad' => $ad]);
    }
}