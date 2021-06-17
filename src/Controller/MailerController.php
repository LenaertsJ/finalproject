<?php


namespace App\Controller;


use http\Env\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController
{
    /**
     * @Route("/email")
     */

    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('julielenaerts@gmail.com')
            ->to('julielenaerts@gamil.com')
            ->subject('Dit is een test')
            ->text('Sending emails is fun again!')
            ->html('<p>See twig integration</p>');

        $mailer->send($email);
        return new Response("Testmail verzonden!");
    }
}