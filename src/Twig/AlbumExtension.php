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
        ];
    }

    public function __construct(SearchData $searchData)
    {
        $this->searchData = $searchData;
    }

    public function searchAlbum($idAlbum)
    {
        return $this->searchData->searchAlbumTracks($idAlbum);
    }
}
