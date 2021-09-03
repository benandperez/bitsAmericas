<?php

namespace App\Controller;

use App\Service\Connection;
use App\Service\SearchData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ReleasesController extends AbstractController
{
    /**
     * @Route("/", name="releases")
     */
    public function index(SearchData $saveAndSearchData, Connection $connection): Response
    {
//        $auth = $connection->connectionAuth();
//        $auth = $this->login();
//        dump('aqui');
//        dd($auth);


        $country = 'CO';
        $limit = 10;
        $offset = 5;
        $getDataApiSpotify = $saveAndSearchData->searchDataSpotifyGeneral($country, $limit, $offset);


            return $this->renderForm('search/index.html.twig', [
            'getDataApiSpotify' => $getDataApiSpotify['albums'],
        ]);
    }

    public function login()
    {
        $clientId = '9a213154321d4123b661ba1d75c9ba9c';
        $redirectUri = 'http://127.0.0.1:8000';
        $scopes = 'user-read-private user-read-email';
        $url='https://accounts.spotify.com/authorize?client_id=9a213154321d4123b661ba1d75c9ba9c&redirect_uri=http://127.0.0.1:8000&&response_type=code';

dump($url);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        dd($data);
        curl_close($ch);

        return $data;


        //En la variable headers se guardan los encabezados y en la variable body el código HTML.


    }
}
