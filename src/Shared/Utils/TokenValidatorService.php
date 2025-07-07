<?php

namespace App\Shared\Utils;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class TokenValidatorService
{
    private string $authToken;

    public function __construct(string $authToken)
    {
        $this->authToken = $authToken;
    }

    public function validate(Request $request): void
    {
        $authHeader = $request->headers->get('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            throw new UnauthorizedHttpException('Bearer', 'Falta el token de autorización');
        }

        $token = substr($authHeader, 7);

        if ($token !== $this->authToken) {
            throw new UnauthorizedHttpException('Bearer', 'Token no válido');
        }
    }
}
