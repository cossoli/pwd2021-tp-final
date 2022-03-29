<?php

namespace Raiz\Rutas;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

final class GlobalRutas implements RutasInterface
{
  public static function configurar(App $app): void
  {
    $app->get(
      pattern: '/',
      callable: function (Request $peticion, Response $respuesta, $args) {
        return Utileria::responderConVista($respuesta, 'home', []);
      },
    );

    $app->get(
      pattern: '/cliente/assets/{asset}',
      callable: function (Request $peticion, Response $respuesta, $args) {
        return Utileria::responderConAsset($respuesta, $args['asset']);
      },
    );
  }
}
