<?php

require 'vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$psr17Factory = new Psr17Factory();
$app = AppFactory::create(null, $psr17Factory);


// Replace with your Agora App ID and App Certificate
$agoraAppId = '1J5efcXgg1uCwNZVgsWkeotJKEQAYBujwE';
$agoraAppCertificate = 'f962afe32ba04e418e4eb50d99cffb10';

$app->post('/generate-token', function (Request $request, Response $response) use ($agoraAppId, $agoraAppCertificate) {
    $data = $request->getParsedBody();
    $channelName = $data['channelName'];
    $uid = $data['uid'];

    $role = Agora\AccessToken\AccessToken::PUBLISHER;

    $accessToken = new Agora\AccessToken\AccessToken($agoraAppId, $agoraAppCertificate, $channelName, $uid, 0);
    $token = $accessToken->build();

    $response->getBody()->write(json_encode(['token' => $token]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
