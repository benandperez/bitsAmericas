<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Artists;
use App\Form\ArtistsType;
use App\Repository\ArtistsRepository;
use App\Service\Connection;
use App\Service\SearchData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artists")
 */
class ArtistsController extends AbstractController
{

    /**
     * @var SearchData
     */
    private $searchData;

    public function __construct(SearchData $searchData)
    {
        $this->searchData = $searchData;
    }

    /**
     * @Route("/", name="artists_index", methods={"GET"})
     */
    public function index(ArtistsRepository $artistsRepository, Connection $connection): Response
    {
        $auth = $connection->connectionAuth();
        return $this->render('artists/index.html.twig', [
            'artists' => $artistsRepository->findAll(),
            'auth' => $auth
        ]);
    }

    /**
     * @Route("/{idSpotify}", name="artists_show", methods={"GET"})
     * @param Artists|null $artist
     * @param Request $request
     * @return Response
     */
    public function show(Artists $artist = null, Request $request, Connection $connection): Response
    {
        $idArtist = $request->get('idSpotify');

        $country = Album::COUNTRY;
        $limit = Album::LIMIT;
        $offset = Album::OFFSET;

        $auth = $connection->connectionAuth();

        $artist = $this->searchData->searchDataSpotifyArtist($idArtist, $country, $limit, $offset, $auth);


        return $this->render('artists/show.html.twig', [
            'artist' => $artist,
            'idArtist' => $idArtist,
            'auth' => $auth
        ]);
    }
}
