<?php

namespace App\Controller;

use App\Entity\Partie;
use App\Form\PartieType;
use App\Repository\PartieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartieController extends AbstractController
{
    #[Route('/partie', name: 'app_partie')]
    public function index(): Response
    {
        return $this->render('partie/index.html.twig', [
            'controller_name' => 'PartieController',
        ]);
    }
    #[Route('/listpartie', name: 'app1_partie')]
    public function list(PartieRepository $partieRepository ): Response
    {   
        $parties=$partieRepository->findAll();
        return $this->render('partie/list.html.twig', [
            'controller_name' => 'partieController',
            'parties' => $parties,
        ]);
    }
    #[Route('/addpartie', name: 'app1_partie')]
    public function add(ManagerRegistry $manage,Request $req): Response
    {
        $Partie=new Partie();
        $em=$manage->getManager();
        $form=$this->createForm(PartieType::class,$Partie);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($Partie);
            $em->flush();
            // Redirect or add a success message
            return $this->redirectToRoute('app0_Partie');
        }

        return $this->renderForm('partie/add.html.twig', [
            'controller_name' => 'PartieController',
            'form' => $form,
        ]);
    }
    #[Route('/updatepartie', name: 'app2_partie')]
    public function update(ManagerRegistry $manage,Request $req): Response
    {
        $Partie=new Partie();
        $em=$manage->getManager();
        $form=$this->createForm(PartieType::class,$Partie);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($Partie);
            $em->flush();
            // Redirect or add a success message
            return $this->redirectToRoute('app0_Partie');
        }

        return $this->renderForm('partie/add.html.twig', [
            'controller_name' => 'PartieController',
            'form' => $form,
        ]);
    }
}
