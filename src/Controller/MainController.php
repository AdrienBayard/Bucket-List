<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home', name: 'home')]
class MainController extends AbstractController
{
    #[Route('/', name: '_index')]
    //#[Route('/', name: 'home_index', methods: ["POST", "GET"])]
    public function index(): Response
    {
        $unObjet = new \DateTime();
        dump($unObjet);
        return $this->render('home/index.html.twig');
    }

    #[Route('/uneautre', name: '_une_autre_page')]
    public function uneAutrePage(): Response
    {
        $nombre = 42;
        dump($nombre);
        return $this->render('home/uneAutrePAge.html.twig');
    }

    #[Route('/page3', name: '_page3')]
    public function page3(): Response
    {
        return $this->render('home/unePage3.html.twig');
    }

    #[Route('/aboutus', name: '_about_us')]
    public function aboutus(): Response
    {
        return $this->render('home/aboutus.html.twig');
    }
}
