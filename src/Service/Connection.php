<?php


namespace App\Service;


class Connection
{

    public function __construct()
    {
    }

    public function getDataApiGeneral($country, $limit, $offset)
    {

        $url = "https://api.spotify.com/v1/browse/new-releases?country=".$country."&limit=".$limit."&offset=".$offset."";
        $header = array('Authorization:  Bearer BQCxghvO_QNrJcvAcRMfYwpAlYQp2WSpxMbhIuNLyMT6EXLVFcEk7aJ7v6ZzqYtwKNaptAcW8uOOmiD2rzads3bvtq52T59ZB5VJhsSytxEPIkxvmZ06mBKfrhr4xSNKkJFWYzdmJz67');

        return $this->connection($url, $header);

    }

    public function getDataApiArtist($idArtist)
    {

        $url = "https://api.spotify.com/v1/artists/".$idArtist;
        $header = array('Authorization:  Bearer BQCxghvO_QNrJcvAcRMfYwpAlYQp2WSpxMbhIuNLyMT6EXLVFcEk7aJ7v6ZzqYtwKNaptAcW8uOOmiD2rzads3bvtq52T59ZB5VJhsSytxEPIkxvmZ06mBKfrhr4xSNKkJFWYzdmJz67');

        return $this->connection($url, $header);

    }

    public function getDataApiArtistAlbums($idArtist, $market, $limit, $offset)
    {

        $url = "https://api.spotify.com/v1/artists/".$idArtist."/albums?market=".$market."&limit=".$limit."&offset=".$offset."";
        $header = array('Authorization:  Bearer BQCxghvO_QNrJcvAcRMfYwpAlYQp2WSpxMbhIuNLyMT6EXLVFcEk7aJ7v6ZzqYtwKNaptAcW8uOOmiD2rzads3bvtq52T59ZB5VJhsSytxEPIkxvmZ06mBKfrhr4xSNKkJFWYzdmJz67');

        return $this->connection($url, $header);

    }


    public function searchAlbumTracks($idAlbum)
    {

        $url = "https://api.spotify.com/v1/albums/".$idAlbum."/tracks?limit=1";
        $header = array('Authorization:  Bearer BQCxghvO_QNrJcvAcRMfYwpAlYQp2WSpxMbhIuNLyMT6EXLVFcEk7aJ7v6ZzqYtwKNaptAcW8uOOmiD2rzads3bvtq52T59ZB5VJhsSytxEPIkxvmZ06mBKfrhr4xSNKkJFWYzdmJz67');

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


        $json = json_decode($response, true);

        return $json;
        
    }

}