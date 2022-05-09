<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Honeypot filter
 */
class SuperAdminFilter implements FilterInterface
{
    /**
     * Checks if Honeypot field is empty, if not then the
     * requester is a bot
     * 
     * @param RequestInterface $request
     * @param array|null $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session()->get('statut') != 3){
            return redirect()->to('accueil');
        }
    }

    /**
     * Attach a honeypot to the current response.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $request
     * @param array|null $arguments
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}