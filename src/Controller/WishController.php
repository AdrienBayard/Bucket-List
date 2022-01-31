<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\CategoryRepository;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @ORM\Entity
 * @ORM\Table(name="wish_controller")
 */
#[Route('/wish', name: 'wish')]
class WishController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/list', name: '_list')]
    public function list(
        WishRepository $wishRepository
    ): Response
    {
        $wishsPublicated = $wishRepository->findWishPublicated("1");

/*      $tousLesWishs = $wishRepository->findBy(["isPublished" =>"true"], ["dateCreated" => "DESC"]); //version plus rapide sans créer le findWishPublicated
        dump($tousLesWishs);*/

        return $this->render('wish/list.html.twig',
        compact(/*"tousLesWishs",*/ "wishsPublicated")
        );

    }

/*    #[Route('/detail/{id}', name: '_detail')]
    public function detail($id): Response
    {
        return $this->render('wish/detail.html.twig',
        compact("id"));
    }*/

    //-----------------------------------------------------------
/*    #[Route('/detail/{id}', name: '_detail')]
    public function detail(
        WishRepository $wishRepository, $id
    ): Response
    {
        $wish = $wishRepository->findOneBy(["id"=>$id], []);

        return $this->render('wish/detail.html.twig',
            ["wish"=>$wish]);
    }*/
    // VERSION JULIEN
    // plus rapide car symfony comprend que wish va travailler avec l'id

    #[Route('/detail/{id}', name: '_detail')]
    public function detail(
        Wish $wish
    ): Response
    {
        return $this->render('wish/detail.html.twig',
            compact("wish")
        );
    }

    //-----------------------------------------------------------


    #[Route('/ajoutdetail', name: '_ajoutdetail')]
    public function ajoutdetail(
        EntityManagerInterface $entityManager
    ): Response
    {
        $idee1 = new Wish();
        $idee1->setTitle("4Une très bonne idée");
        $idee1->setDescription("4Une très bonne idée décrite parfaitement!");
        $idee1->setAuthor("4Adrien");
        $idee1->setIsPublished("true");
        $idee1->setDateCreated(new \DateTime());
        $entityManager->persist($idee1);
        $entityManager->flush();

        return $this->render('wish/ajoutdetail.html.twig'
        );
    }


    #[Route('/addwish', name: '_addwish')]
    public function addwish(
        Request $request,
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository
    ): Response
    {
        $wish = new wish();
        $wishFormulaire = $this->createForm(WishType::class, $wish);

        $wishFormulaire->handleRequest($request); //------------------
        if($wishFormulaire->isSubmitted()
            && $wishFormulaire->isValid()  //---permet de vérifier avnt d'envoyer en base

        ){         //------ permet d'insérer le formulaire en bdd

            $entityManager->persist($wish);
            $entityManager->flush();


            $this->addFlash("bravo","Idea successfully added @Dev_Adrien");
            return $this->redirectToRoute("wish_detail",['id' => $wish->getId()]); //rediriger vers une route "après formulaire"
        }


        return $this->render('wish/addwish.html.twig',
            ["wishFormulaire" => $wishFormulaire->createView()
                ]);
    }



}
