<?php

namespace App\Domain\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticationFailureListener
{
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event): void
    {
        $response = new JsonResponse([
            'errors' => [
                'message' => $event->getException()->getMessage(),
            ]
        ], 401);

        $event->setResponse($response);
    }
}
