<?php


namespace App\Service;


class Connection
{

    public function __construct()
    {
    }

    public function getDataApiGeneral($country, $limit, $offset, $auth)
    {

        $url = "https://api.spotify.com/v1/browse/new-releases?country=".$country."&limit=".$limit."&offset=".$offset."";
        $header = array('Authorization:  Bearer '.$auth['access_token'].'');


        return $this->connection($url, $header);

    }

    public function getDataApiArtist($idArtist, $auth)
    {

        $url = "https://api.spotify.com/v1/artists/".$idArtist;
        $header = array('Authorization:  Bearer '.$auth['access_token'].'');

        return $this->connection($url, $header);

    }

    public function getDataApiArtistAlbums($idArtist, $market, $limit, $offset, $auth)
    {

        $url = "https://api.spotify.com/v1/artists/".$idArtist."/albums?market=".$market."&limit=".$limit."&offset=".$offset."";
        $header = array('Authorization:  Bearer '.$auth['access_token'].'');

        return $this->connection($url, $header);

    }


    public function searchAlbumTracks($idAlbum, $auth)
    {

        $url = "https://api.spotify.com/v1/albums/".$idAlbum."/tracks?limit=1";
        $header = array('Authorization:  Bearer '.$auth['access_token'].'');

        return $this->connection($url, $header);

    }




    public function connection($url, $header)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($ch);
        curl_close($ch);


        return json_decode($response, true);
        
    }


    public function connectionAuth()
    {
        $client_id = '9a213154321d4123b661ba1d75c9ba9c';
        $client_secret = 'd5d3e3fb09914a96b7ead329884ba028';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' );
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret)));

        $response=curl_exec($ch);

        curl_close($ch);


        return json_decode($response, true);

    }

}