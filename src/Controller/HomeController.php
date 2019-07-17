<?php

namespace App\Controller;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $company = $entityManager->getRepository(Company::class)->findOneBy([]);

        return $this->render('home/index.html.twig', [
            'company' => $company,
        ]);
    }
}
