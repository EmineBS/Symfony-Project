<?php

namespace App\Controller;

use App\Entity\VinylMix;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;
use Doctrine\ORM\EntityManagerInterface;


class VinylController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    function homepage(): Response
    {
        $tracks = [
            ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['song' => 'Waterfalls', 'artist' => 'TLC'],
            ['song' => 'Creep', 'artist' => 'Radiohead'],
            ['song' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];
        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'ISET Kélibia',
            'tracks' => $tracks,
        ]);
    }
    #[Route('/browse/{slug}', name: 'app_browse')]
    public function browse(EntityManagerInterface $entityManager, string $slug = null): Response
    {
        $mixRepository = $entityManager->getRepository(VinylMix::class);
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        $mixes = $mixRepository->findAll();
        //dd($mixes);
        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
}
