<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OwnerRegistrationController extends AbstractController
{
    /**
     * @Route("/owner/register", name="ownerRegistration.store", methods={"POST"})
     */
    public function storeOwnerRegistration()
    {


        return $this->json("giddy Up")  ;
    }
}
