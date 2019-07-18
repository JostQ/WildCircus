<?php


namespace App\Service;


use App\Repository\CompanyRepository;
use Twig\Environment;

class Mailer
{
    private $sender;
    private $mailer;
    private $twig;
    private $company;

    public function __construct(\Swift_Mailer $mailer, string $sender, Environment $twig, CompanyRepository $companyRepository)
    {
        $this->company = $companyRepository->findOneBy([]);
        $this->mailer = $mailer;
        $this->sender = $sender;
        $this->twig = $twig;
    }
    public function sendMail($message, $recipient, $subject, $repo)
    {
        $message = (new \Swift_Message())
            ->setFrom($this->sender)
            ->setTo($recipient)
            ->setSubject($subject)
            ->setBody($this->twig->render(
                $repo . '/mailer/mail.html.twig',
                [
                    'company' => $this->company,
                    'recipient' => $recipient,
                    'message' => $message
                ]
            ),
                'text/html');
        $this->mailer->send($message);
    }
}