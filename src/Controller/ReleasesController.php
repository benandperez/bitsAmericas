<?php

namespace App\Controller;

use App\Service\SearchData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReleasesController extends AbstractController
{
    /**
     * @Route("/", name="releases")
     */
    public function index(SearchData $saveAndSearchData): Response
    {

        $country = 'CO';
        $limit = 10;
        $offset = 5;
        $getDataApiSpotify = $saveAndSearchData->searchDataSpotifyGeneral($country, $limit, $offset);


            return $this->renderForm('search/index.html.twig', [
            'getDataApiSpotify' => $getDataApiSpotify['albums'],
        ]);
    }
}
