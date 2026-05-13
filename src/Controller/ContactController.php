<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request,
        MailerService $mailerService,
        #[Autowire(service: 'limiter.contact_form')]
        RateLimiterFactory $contactLimiter
    ): Response {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // Honeypot
            if ($form->has('website') && !empty($form->get('website')->getData())) {
                throw $this->createNotFoundException();
            }

            // Anti soumission trop rapide
            $formTime = (int) $request->request->get('formTime', 0);

            if ($formTime > 0 && time() - $formTime < 3) {
                $this->addFlash('error', 'Merci de patienter quelques secondes avant d’envoyer le formulaire.');

                return $this->redirectToRoute('app_contact');
            }

            // Rate limit uniquement à l’envoi
            $limiter = $contactLimiter->create($request->getClientIp());

            if (!$limiter->consume()->isAccepted()) {
                $this->addFlash('error', 'Trop de tentatives, réessaie plus tard.');

                return $this->redirectToRoute('app_contact');
            }
            if ($form->has('website') && !empty($form->get('website')->getData())) {
    $this->addFlash('success', 'Ton message a bien été envoyé ✨');

    return $this->redirectToRoute('app_contact');
}
            if ($form->isValid()) {
                $mailerService->sendContactEmail($form->getData());

                $this->addFlash('success', 'Ton message a bien été envoyé ✨');

                return $this->redirectToRoute('app_contact');
            }
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
            'formTime' => time(),
        ]);
    }
}
