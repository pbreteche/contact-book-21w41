<?php

namespace App\Pegase;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Test1
{
    private HttpClientInterface $client;

    public function __construct()
    {
        $this->client = HttpClient::create();
    }

    public function test()
    {

        $response = $this->client->request('GET', 'https://api.github.com/repos/symfony/symfony-docs');


        $response = $this->client->request('GET', 'https://geo.api.gouv.fr/communes', [
            'query' => [
                'nom' => 'Nantès',
                'fields' => 'nom',
                'format' => 'json',
                'geometry' => 'centre',
            ],
            'headers' => [
                'accept' => 'application/json',
            ],
        ]);
        $response = $this->client->request('GET', 'https://authz.test-univ-nantes.pc-scol.fr/api/authz/autorisation/v4/utilisateurs', [
            'query' => [
                'page' => 0,
                'taille' => 10,
            ],
            'headers' => [
                'accept' => 'application/json',
                'Authorization' => 'Bearer '.include __DIR__.'/../../token.php',
            ],
        ]);

        $listeUtilisateur = json_decode($response->getContent())->items;

        foreach($listeUtilisateur as $utilisateur) {
            echo '<p>'.$utilisateur->idUtilisateur.'</p>';
        }

        //header('Content-type: application/json');
        //echo $response->getContent();
    }
}
