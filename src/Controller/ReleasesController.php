<?php

namespace App\Controller;

use App\Entity\Album;
use App\Service\Connection;
use App\Service\SearchData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReleasesController extends AbstractController
{
    /**
     * @Route("/", name="releases")
     */
    public function index(SearchData $saveAndSearchData, Connection $connection, Request $request): Response
    {
        $auth = $connection->connectionAuth();

        $country = Album::COUNTRY;
        $limit = Album::LIMIT;
        $offset = Album::OFFSET;

        if ($request->get('country') !== null){
            $country = $request->get('country');
        }



        $getDataApiSpotify = $saveAndSearchData->searchDataSpotifyGeneral($country, $limit, $offset, $auth);

            return $this->renderForm('search/index.html.twig', [
            'getDataApiSpotify' => $getDataApiSpotify['albums'],
        ]);
    }

}
