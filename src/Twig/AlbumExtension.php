<?php

namespace App\Twig;

use App\Service\SearchData;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AlbumExtension extends AbstractExtension
{

    /**
     * @var SearchData
     */
    private $searchData;

    public function getFunctions(): array
    {
        return [
            new TwigFunction('searchAlbumTracks', [$this, 'searchAlbum']),
            new TwigFunction('searchArtist', [$this, 'searchArtist']),
        ];
    }

    public function __construct(SearchData $searchData)
    {
        $this->searchData = $searchData;
    }

    public function searchAlbum($idAlbum, $auth)
    {
        return $this->searchData->searchAlbumTracks($idAlbum, $auth);
    }
    public function searchArtist($idArtist, $auth)
    {
        return $this->searchData->searchArtist($idArtist, $auth);
    }
}
