<?php

namespace App\Controller;

use App\Entity\Artists;
use App\Form\ArtistsType;
use App\Repository\ArtistsRepository;
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
    public function index(ArtistsRepository $artistsRepository): Response
    {
        return $this->render('artists/index.html.twig', [
            'artists' => $artistsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{idSpotify}", name="artists_show", methods={"GET"})
     * @param Artists|null $artist
     * @param Request $request
     * @return Response
     */
    public function show(Artists $artist = null, Request $request): Response
    {
        $idArtist = $request->get('idSpotify');
        $country = 'CO';
        $limit = 10;
        $offset = 5;
        if (!isset($artist)) {
            $artist = $this->searchData->searchDataSpotifyArtist($idArtist, $country, $limit, $offset);

            $template = $this->render('artists/show.html.twig', [
                'artist' => $artist,
            ]);

        } else {
            $template = $this->render('artists/index.html.twig', [
                'artist' => $artist,
            ]);
        }


        return $template;
    }
}
