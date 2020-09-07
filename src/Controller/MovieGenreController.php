<?php

namespace App\Controller;

use App\Repository\MovieGenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MovieGenreController extends AbstractController
{
    /**
     * @Route("/api/moviegenres", name="moviegenres.list" , methods={"GET"})
     * @param MovieGenreRepository $movieGenreRepository
     * @return JsonResponse
     */
    public function listGenres(MovieGenreRepository $movieGenreRepository)
    {
        $genres = $movieGenreRepository->findAll() ;

        return $this->json($genres,200,[],['groups'=>['moviegenre:list']]);
    }
}
