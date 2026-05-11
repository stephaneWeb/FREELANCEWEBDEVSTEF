<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailerService
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig
    ) {
    }

    public function sendContactEmail(array $data): void
    {
        $html = $this->twig->render('emails/contact.html.twig', [
            'data' => $data,
        ]);

        $email = (new Email())
            ->from('stephanedev85@gmail.com')
            ->to('stephanedev85@gmail.com')
            ->replyTo($data['email'])
            ->subject('Nouveau message Atelier Halo : ' . $data['subject'])
            ->html($html);

        $this->mailer->send($email);
    }
}
