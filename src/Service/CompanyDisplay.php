<?php


namespace App\Service;

use App\Repository\CompanyRepository;
use Twig\Environment;

class CompanyDisplay
{

    public function __construct(CompanyRepository $companyRepository, Environment $twig)
    {
        return $companyRepository->findBy([]);
    }

}