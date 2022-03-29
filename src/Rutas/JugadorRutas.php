<?php

namespace Raiz\Rutas;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Raiz\Controladores\JugadorControlador;

final class JugadorRutas implements RutasInterface
{
  public static function configurar(App $app): void
  {
    // API
    $app->get(
      pattern: '/api/jugadores',
      callable: function (Request $peticion, Response $respuesta, $args) {
        return Utileria::responderConJson(
          respuesta: $respuesta,
          datos: JugadorControlador::listar(),
        );
      },
    );

    $app->get(
      pattern: '/api/jugadores/{id}',
      callable: function (Request $peticion, Response $respuesta, array $args) {
        $datos = JugadorControlador::buscarPorId(id: $args['id']);

        if (is_null(value: $datos)) {
          $respuesta = $respuesta->withStatus(404);
        }

        return Utileria::responderConJson(respuesta: $respuesta, datos: $datos);
      },
    );

    $app->post(
      pattern: '/api/jugadores',
      callable: function (Request $peticion, Response $respuesta, $args) {
        return Utileria::responderConJson(
          respuesta: $respuesta,
          datos: JugadorControlador::crear(
            parametros: $peticion->getParsedBody(),
          ),
        );
      },
    );

    $app->put(
      pattern: '/api/jugadores/{id}',
      callable: function (Request $peticion, Response $respuesta, array $args) {
        $body = $peticion->getParsedBody();
        $body['id'] = $args['id'];

        return Utileria::responderConJson(
          respuesta: $respuesta,
          datos: JugadorControlador::actualizar(parametros: $body),
        );
      },
    );

    $app->delete(
      pattern: '/api/jugadores/{id}',
      callable: function (Request $peticion, Response $respuesta, array $args) {
        JugadorControlador::borrar(id: $args['id']);

        return $respuesta;
      },
    );

    $app->get(
      pattern: '/jugadores',
      callable: function (Request $peticion, Response $respuesta, $args) {
        return Utileria::responderConVista($respuesta, 'home', []);
      },
    );
    $app->get(
      pattern: '/jugadores/crear',
      callable: function (Request $peticion, Response $respuesta, $args) {
        return Utileria::responderConVista($respuesta, 'home', []);
      },
    );
    $app->get(
      pattern: '/jugadores/{id}',
      callable: function (Request $peticion, Response $respuesta, $args) {
        return Utileria::responderConVista($respuesta, 'home', []);
      },
    );
  }
}
