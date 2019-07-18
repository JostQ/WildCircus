<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_index")
     */
    public function index(Request $request, Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())  {

            $message = $form->getData();
            $subjectMail = 'Wild Circus - You contacted us !';

            $mailer->sendMail($message, $message['email'], $subjectMail, 'contact');

            $this->addFlash('success', 'We get your message! Thank you !');

            return $this->redirectToRoute('contact_index');

        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
