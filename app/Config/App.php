<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     */
    public string $baseURL = 'http://localhost:8080/';

    /**
     * Allowed Hostnames in the Site URL
     * @var list<string>
     */
    public array $allowedHostnames = [];

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     */
    public string $uriProtocol = 'REQUEST_URI';

    public string $permittedURIChars = 'a-z 0-9~%.:_\-';

    /**
     * --------------------------------------------------------------------------
     * Default Locale
     * --------------------------------------------------------------------------
     */
    public string $defaultLocale = 'en';

    public bool $negotiateLocale = false;

    /**
     * Supported Locales
     * @var list<string>
     */
    public array $supportedLocales = ['en'];

    public string $appTimezone = 'UTC';

    public string $charset = 'UTF-8';

    public bool $forceGlobalSecureRequests = false;

    /**
     * Reverse Proxy IPs
     * @var array<string, string>
     */
    public array $proxyIPs = [];

    public bool $CSPEnabled = false;

    /**
     * --------------------------------------------------------------------------
     * CSRF Protection (for web forms)
     * --------------------------------------------------------------------------
     */
    public string $CSRFProtection = 'session';
    public string $CSRFTokenName = 'csrf_token';
    public string $CSRFHeaderName = 'X-CSRF-TOKEN';
    public string $CSRFCookieName = 'csrf_cookie';
    public int $CSRFExpire = 7200;
    public bool $CSRFRegenerate = true;
    public bool $CSRFRedirect = true;
    public array $CSRFExcludeURIs = ['api/*'];

    /**
     * --------------------------------------------------------------------------
     * CORS Configuration (for API)
     * --------------------------------------------------------------------------
     */
    public bool $CORSEnabled = true;
    public array $allowedOrigins = ['*'];
    public array $allowedMethods = ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'];
    public array $allowedHeaders = [
        'Origin',
        'X-Requested-With',
        'Content-Type',
        'Accept',
        'Authorization',
        'X-API-KEY'
    ];
    public bool $allowCredentials = false;
    public int $maxAge = 3600;

    /**
     * --------------------------------------------------------------------------
     * API Configuration
     * --------------------------------------------------------------------------
     */
    public string $APIPrefix = 'api';
    public string $APIDefaultFormat = 'json'; // json or xml
    public bool $APIStrictMode = false;
    public bool $APIDebugMode = true;
    public array $APIAllowedAuthMethods = ['jwt', 'api_key'];
    public string $APIDefaultAuthMethod = 'jwt';
    public int $APIRateLimit = 1000; // Requests per hour
    public int $APIRateLimitPeriod = 3600; // Seconds

    /**
     * --------------------------------------------------------------------------
     * Session Configuration (for web authentication)
     * --------------------------------------------------------------------------
     */
    public string $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionCookieName = 'ci_session';
    public int $sessionExpiration = 7200;
    public string $sessionSavePath = WRITEPATH . 'session';
    public bool $sessionMatchIP = false;
    public int $sessionTimeToUpdate = 300;
    public bool $sessionRegenerateDestroy = true;
}