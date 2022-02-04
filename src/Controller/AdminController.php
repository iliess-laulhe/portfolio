<?php

namespace App\Controller;


use App\Entity\Project;
use App\Entity\Skill;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="show")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $skills = $managerRegistry->getRepository(Skill::class)->findAll();
        $projects = $managerRegistry->getRepository(Project::class)->findAll();
        return $this->render('admin/index.html.twig', [
            'skills' => $skills,
            'projects' => $projects
        ]);
    }
    /**
     * @Route("/adminEdit/{id}", name="edit")
     */
    public function edit(Request $request, ManagerRegistry $managerRegistry, Project $project):Response
    {
        $entityManager = $managerRegistry->getManager();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($project);
            $entityManager->flush();
            return $this->redirectToRoute('admin_show');
        }

        return $this->render('admin/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    /**
     * @Route("/deleteProject/{id}", name="deleteProject")
     */
    public function deleteProject(Project $project, ManagerRegistry $managerRegistry,  EntityManagerInterface $entityManager): Response
    {
        $entityManager = $managerRegistry->getManager();
        $entityManager->remove($project);
        $entityManager->flush();
        return $this->redirectToRoute('admin_show');
    }

    /**
     * @Route("/deleteSkill/{id}", name="deleteSkill")
     */
    public function delete(Skill $skill, ManagerRegistry $managerRegistry,  EntityManagerInterface $entityManager): Response
    {
        $entityManager = $managerRegistry->getManager();
        $entityManager->remove($skill);
        $entityManager->flush();
        return $this->redirectToRoute('admin_show');
    }
}
