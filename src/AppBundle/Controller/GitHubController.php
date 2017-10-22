<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Github\Client;

class GitHubController extends Controller
{
    /**
     * @Route("/list", name="listdir")
     */
    public function indexAction(Request $request)
    {
        
        $client = new Client();

        $repos = $client->api('repo')->find('symfony');

        $repositories = $repos['repositories'];

        $symfony_repos = array();

        foreach($repositories as $repository){
            if (strpos($repository['url'], 'https://github.com/symfony/') !== false) {
                
                $symfony_repos[] = $repository;
                
            }
        }

        return $this->render('github/index.html.twig', [
                'repos' => $symfony_repos,
            ]);

    }
}
