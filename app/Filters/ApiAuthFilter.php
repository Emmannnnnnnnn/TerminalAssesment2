<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class ApiAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authenticated = false;
        
        // Check for API key in header
        $apiKey = $request->getHeaderLine('X-API-KEY');
        if (!empty($apiKey)) {
            $authenticated = $this->validateApiKey($apiKey);
        }
        
        // Check for JWT token
        if (!$authenticated) {
            $authHeader = $request->getHeaderLine('Authorization');
            if (!empty($authHeader) && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                $authenticated = $this->validateJWT($matches[1]);
            }
        }
        
        if (!$authenticated) {
            return Services::response()
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ])
                ->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here if needed
    }

    protected function validateApiKey(string $key): bool
    {
        // Implement your API key validation logic
        $validKeys = [env('API_KEY')]; // Store keys in .env
        return in_array($key, $validKeys);
    }

    protected function validateJWT(string $token): bool
    {
        // Implement JWT validation logic
        try {
            $jwt = Services::jwt();
            return $jwt->validate($token);
        } catch (\Exception $e) {
            return false;
        }
    }
}