<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/ad/{slug}", name="ad_show")
     *
     * @return void
     */
    public function show(Ad $ad)
    {

        return $this->render("ad/show.html.twig", ['ad' => $ad]);
    }
}