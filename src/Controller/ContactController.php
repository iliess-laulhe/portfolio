<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Skill;
use App\Form\ContactType;
use App\Form\SkillType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
        public function index(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $managerRegistry->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            return $this->redirectToRoute('home_skill');

        }
        return $this->renderForm('contact/index.html.twig', [
            'form' => $form,
        ]);
    }

}
