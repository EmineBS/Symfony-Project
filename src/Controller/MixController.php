<?php

namespace App\Controller;

use App\Entity\VinylMix;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\VinylMixRepository;


class MixController extends AbstractController
{
    #[Route('/mix/new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $genres = ['pop', 'rock'];

        $mix = new VinylMix();
        $mix->setTitle('Do you Remember... Phil Collins?!');
        $mix->setDiscription('A pure mix of drummers turned singers!');
        $mix->setGenre($genres[array_rand($genres)]);
        //$mix->setGenre('pop');
        $mix->setTrackCount(rand(5, 20));
        $mix->setVotes(rand(-50, 50));

        $entityManager->persist($mix);
        $entityManager->flush();

        return new Response(sprintf(
            'Mix %d is %d tracks of pure 80\'s heaven',
            $mix->getId(),
            $mix->getTrackCount()
        ));
    }

    #[Route('/mix/{id}', name: 'app_mix_show')]
    public function show($id, VinylMixRepository $mixRepository): Response
    {
        $mix = $mixRepository->find($id);
        //dd($id);

        return $this->render('mix/show.html.twig', [
            'mix' => $mix,
        ]);
    }
}
