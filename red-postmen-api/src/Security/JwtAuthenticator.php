<?php

namespace App\Security;

use App\Service\JwtService;
use Symfony\Component\HttpKernel\Event\RequestEvent;


class JwtAuthenticator 
{
    private JwtService $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    /**
     * We return the user info to be proccess in other Controller
     * To get the info on the controller, just do $request->attributes->get('user_payload');
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $path = $request->getPathInfo();

        // The route that we exclude from the verification
        $publicPaths = [
            '/api/login',
        ];
        foreach ($publicPaths as $publicPath) {
            if (str_starts_with($path, $publicPath)) {
                return;
            }
        }

        $data = $this->jwtService->decryptTokenRolesFromRequest($request);
        $request->attributes->set('user_payload', $data);
    }


}