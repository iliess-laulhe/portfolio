<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Skill;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/home", name="home_")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="project")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $projects = $managerRegistry->getRepository(Project::class)->findAll();
        return $this->render('home/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    /**
     * @Route("/skillshow", name="skill")
     */
    public function show (ManagerRegistry $managerRegistry): Response
    {
        $skills = $managerRegistry->getRepository(Skill::class)->findAll();
        return $this->render('skill/show.html.twig', [
            'skills' => $skills
        ]);
    }
}
