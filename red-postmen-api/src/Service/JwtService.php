<?php

namespace App\Service;

use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\JWK;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\Signature\JWSVerifier;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class JwtService
{

    public function signToken(User $user): string 
    {
        $algorithmManager = new AlgorithmManager([new HS256()]);
        $secret = $_ENV['JWT_SECRET'];
        $key = new JWK([
            'kty' => 'oct',
            'k' => rtrim(strtr(base64_encode($secret), '+/', '-_'), '='),
        ]);
        $jwsBuilder = new JWSBuilder($algorithmManager);
        $payload = json_encode([
            'iat' => time(),
            'exp' => time() + 3600 * 24 * 2, // 3600 = 1h, then 24 day, then 2 day, the token is valid two days
            'sub' => ['username' => $user->getUserIdentifier(), 'roles' => $user->getRoles()],
        ]);
        $jws = $jwsBuilder
            ->create()
            ->withPayload($payload)
            ->addSignature($key, ['alg' => 'HS256'])
            ->build();
        $serializer = new CompactSerializer();
        return $serializer->serialize($jws);
    }

    /**
     * Get the payload user linked to the token, if the token is valid
     */
    public function decryptTokenRolesFromRequest(Request $request): array
    {
        $algorithmManager = new AlgorithmManager([new HS256()]);
        $secret = $_ENV['JWT_SECRET'];
        $key = new JWK([
            'kty' => 'oct',
            'k' => rtrim(strtr(base64_encode($secret), '+/', '-_'), '='),
        ]);
        $jwsVerifier = new JWSVerifier($algorithmManager);
        $serializer = new CompactSerializer();

        // TODO verify presence
        $token = $request->headers->get('Authorization');
        if (is_null($token)) {
            // TODO better redirection if fail
            throw new \Exception('No token');
        }

        try {
            $jws = $serializer->unserialize($token);
            if (!$jwsVerifier->verifyWithKey($jws, $key, 0)) {
                // TODO better redirection if fail
                throw new \Exception('Invalid token signature');
            }

            $payload = $jws->getPayload();
            $data = json_decode($payload, true);

            $now = time();
            if (isset($data['exp']) && $data['exp'] < $now) {
                // TODO better redirection if fail
                throw new \Exception('Token expired');
            }

            return $data['sub'];
        } catch (\Exception $e) {
            // TODO better redirection if fail
            throw new \Exception('Token verification failed: ' . $e->getMessage());
        }
    }
    
}