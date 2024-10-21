<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Form\JoueurType;
use App\Repository\JoueurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JoueurController extends AbstractController
{
    #[Route('/joueur', name: 'app_joueur')]
    public function index(): Response
    {
        return $this->render('joueur/index.html.twig', [
            'controller_name' => 'JoueurController',
        ]);
    }
    #[Route('/listjoueur', name: 'app0_joueur')]
    public function list(JoueurRepository $joueurRepository ): Response
    {   
        $joueurs=$joueurRepository->findAll();
        return $this->render('joueur/list.html.twig', [
            'controller_name' => 'joueurController',
            'joueurs' => $joueurs,
        ]);
    }
    #[Route('/addjoueur', name: 'app1_joueur')]
    public function add(ManagerRegistry $manage,Request $req): Response
    {
        $joueur=new Joueur();
        $em=$manage->getManager();
        $form=$this->createForm(JoueurType::class,$joueur);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($joueur);
            $em->flush();
            // Redirect or add a success message
            return $this->redirectToRoute('app0_joueur');
        }

        return $this->renderForm('joueur/add.html.twig', [
            'controller_name' => 'joueurController',
            'form' => $form,
        ]);
    }
    #[Route('/updatejoueur/{id}', name: 'app2_joueur')]
    public function update(ManagerRegistry $manage,Request $req,$id): Response
    {
        
        $em=$manage->getManager();
        $joueur=$em->getRepository(joueur::class)->find($id);
        $form=$this->createForm(joueurType::class,$joueur);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($joueur);
            $em->flush();
            // Redirect or add a success message
            return $this->redirectToRoute('app0_joueur');
        }

        return $this->renderForm('joueur/add.html.twig', [
            'controller_name' => 'joueurController',
            'form' => $form,
        ]);
    }
    #[Route('/deletejoueur/{id}', name: 'app3_joueur')]
    public function deleteform(ManagerRegistry $manager,$id): Response
    {   
        $em=$manager->getManager();
        $joueur=$em->getRepository(joueur::class)->find($id);
        $em->remove($joueur);
        $em->flush();
        return $this->redirectToRoute('app0_joueur');
    }
}
