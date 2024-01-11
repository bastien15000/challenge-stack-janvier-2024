<?php

namespace App\Services;

use App\Entity\User;

class JWTService
{
    public function __construct(
        private readonly string $JWT_SECRET_KEY,
    ) {}

    public function createJWT(User $user): string
    {
        // Create token header as a JSON string
        $header = json_encode(['type' => 'JWT', 'alg' => 'HS256']);

        // Create token payload as a JSON string
        $payload = json_encode(['user_id' => $user->getId()]);

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $this->JWT_SECRET_KEY, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    public function verifyToken(string $token): bool
    {
        $tokens = explode('.', $token);

        $signature = hash_hmac('sha256', $tokens[0] . "." . $tokens[1], $this->JWT_SECRET_KEY, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return $tokens[2] == $base64UrlSignature;
    }
}