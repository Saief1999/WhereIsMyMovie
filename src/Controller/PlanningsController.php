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
       return $this->render("inner-page.html.twig");
    }
}
