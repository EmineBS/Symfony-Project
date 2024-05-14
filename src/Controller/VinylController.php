<?php

namespace App\Controller;

use App\Entity\VinylMix;
use Pagerfanta\Pagerfanta;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\String\u;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function browse(EntityManagerInterface $entityManager, Request $request, string $slug = null): Response
    {
        $mixRepository = $entityManager->getRepository(VinylMix::class);
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        //$mixes = $mixRepository->findAllOrderedByVotes();
        //$mixes = $mixRepository->findBy([], ['votes' => 'DESC']);
        //$mixes = $mixRepository->findAll();
        //dd($mixes);
        $queryBuilder = $mixRepository->findAllOrderedByVotes($slug);
        $adapter = new QueryAdapter($queryBuilder);
        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            9
        );
        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'pager' => $pagerfanta,
        ]);
    }
}
