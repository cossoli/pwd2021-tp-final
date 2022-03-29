<?php

namespace Raiz\Rutas;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class Utileria
{
  /**
   * @param mixed[] $args
   */
  public static function responderConVista(
    Response $respuesta,
    string $vista,
    array $args,
  ): Response {
    $phpView = new PhpRenderer(templatePath: __DIR__ . '/../Vistas');

    return $phpView->render(
      response: $respuesta,
      template: "$vista.html",
      data: $args,
    );
  }

  public static function responderConAsset(
    Response $respuesta,
    string $asset,
  ): Response {
    $phpView = new PhpRenderer(templatePath: __DIR__ . '/../../cliente/assets');

    return $phpView->render(response: $respuesta, template: $asset);
  }

  public static function responderConJson(
    Response $respuesta,
    mixed $datos,
  ): Response {
    $respuesta
      ->getBody()
      ->write(
        string: json_encode(
          value: $datos,
          flags: JSON_THROW_ON_ERROR,
          depth: 512,
        ),
      );

    return $respuesta->withHeader(
      name: 'Content-Type',
      value: 'application/json',
    );
  }
}
