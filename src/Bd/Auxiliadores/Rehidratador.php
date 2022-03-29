<?php

namespace Raiz\Bd\Auxiliadores;

use Phpmig\Api\PhpmigApplication;
use Symfony\Component\Console\Output\NullOutput;

class Rehidratador
{
  private static ?PhpmigApplication $app = null;

  private function __construct()
  {
  }
  public static function ejecutar(): void
  {
    if (!self::$app) {
      $container = require __DIR__ . '/../../../hidratador.php';
      $output = new NullOutput();

      self::$app = new PhpmigApplication(
        container: $container,
        output: $output,
      );
    }

    self::$app->down();
    self::$app->up();
  }
}
