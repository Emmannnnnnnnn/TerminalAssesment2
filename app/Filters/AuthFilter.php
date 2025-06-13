<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Skip for API requests
        if (strpos($request->getUri()->getPath(), 'api/') === 0) {
            return;
        }

        // Check for web session authentication
        if (!session()->get('isLoggedIn')) {
            // Store intended URL before redirect
            session()->set('redirect_url', current_url());
            return redirect()->to('/login');
        }

        // Check admin role if required
        if (!empty($arguments)) {
            $userRole = session()->get('role');
            if (!in_array($userRole, $arguments)) {
                return redirect()->to('/')->with('error', 'Unauthorized access');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Add security headers
        $response->setHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->setHeader('X-XSS-Protection', '1; mode=block');
        $response->setHeader('X-Content-Type-Options', 'nosniff');
    }
}