<?php

use App\Repository\VinylMixRepository;

class TalkToMeCommand extends Command
{
    public function __construct(
        private VinylMixRepository $mixRepository
    ){}
}