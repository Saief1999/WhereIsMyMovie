<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlanningsController extends AbstractController
{
    /**
     * @Route("/plannings", name="plannings")
     */
    public function index()
    {
        $this->addFlash("success","Simple Success message");
       return $this->render("plannings/index.html.twig");
    }
}
