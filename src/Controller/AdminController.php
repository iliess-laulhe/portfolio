<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Skill;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
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
}
