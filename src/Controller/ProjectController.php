<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/project", name="project_")
 */
class ProjectController extends AbstractController
{

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class,$project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $managerRegistry->getManager();
            $entityManager->persist($project);
            $entityManager->flush();
            $this->addFlash('success', 'Votre Projet a bien été ajouté.');
        }
        return $this->renderForm('project/new.html.twig', [
            'form' => $form,
        ]);
    }
}
