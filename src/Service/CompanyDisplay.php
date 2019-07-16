<?php


namespace App\Service;

use App\Repository\CompanyRepository;
use App\Repository\MediaRepository;
use App\Repository\TypeRepository;
use Twig\Environment;

class CompanyDisplay
{
    private $company;
    private $logo;

    public function __construct(CompanyRepository $companyRepository, MediaRepository $mediaRepository, TypeRepository $typeRepository)
    {
        $this->company = $companyRepository->findBy([])[0];
        $type = $typeRepository->findOneBy(['name' => 'logoCompany']);
        $this->logo = $mediaRepository->findOneBy(['type' => $type]);
    }

    public function getLogo()
    {
        return $this->logo;
    }

}