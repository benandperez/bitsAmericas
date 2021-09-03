<?php


namespace App\Service;


use App\Entity\Artists;
use App\Repository\ArtistsRepository;
use Doctrine\ORM\EntityManagerInterface;

class SearchData
{

    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ArtistsRepository
     */
    private $artistsRepository;


    /**
     * SaveAndSearchData constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection, EntityManagerInterface $entityManager, ArtistsRepository $artistsRepository)
    {
        $this->connection = $connection;
        $this->entityManager = $entityManager;
        $this->artistsRepository = $artistsRepository;
    }

    public function searchDataSpotifyGeneral($country = null, $limit = null, $offset = null)
    {

        return $this->connection->getDataApiGeneral($country, $limit, $offset);
    }

    public function searchDataSpotifyArtist($idArtist = null, $country = null, $limit = null, $offset = null)
    {
        $dataArtist = $this->searchArtist($idArtist);

        $artistDB = $this->artistsRepository->findOneBy(['idSpotify' => $dataArtist['id']]);

        if (!isset($artistDB)) {
            $artist = new Artists();
            $artist->setIdSpotify($dataArtist['id']);
            $artist->setApiHref($dataArtist['href']);
            $artist->setExternalUrls($dataArtist['external_urls']['spotify']);
            $artist->setName($dataArtist['name']);
            $artist->setUri($dataArtist['uri']);
            $artist->setImage($dataArtist['images'][0]['url']);
            $artist->setCreatedAt(new \DateTime());
            $artist->setUpdatedAt(new \DateTime());

            $this->entityManager->persist($artist);
            $this->entityManager->flush();
        }


        return $this->connection->getDataApiArtistAlbums($idArtist, $country, $limit, $offset);
    }

    public function searchAlbumTracks($idAlbum)
    {

        return $this->connection->searchAlbumTracks($idAlbum);
    }

    public function searchArtist($idArtist)
    {

        return $this->connection->getDataApiArtist($idArtist);
    }

}