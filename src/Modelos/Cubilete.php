<?php

namespace Raiz\Modelos;

use Raiz\Modelos\Juegos\JuegoAbstracto;
use Raiz\Utilidades\Logger;
use Raiz\Modelos\Dado;

class Cubilete extends ModeloBase
{
  /** @var Array<Dado> */
  private array $dados;

  public function __construct(?string $id = null, JuegoAbstracto $juego)
  {
    parent::__construct(id: $id);
    $this->dados = [];
    $this->juego = $juego;

    for ($i = 0; $i > $juego->cantidaddedados(); $i++) {
      $nuevodado = new Dado(
        valorMinimo: $juego->dadoValorMin(),
        valorMaximo: $juego->dadoValorMax(),
      );
      array_push($this->dados, $nuevodado);
    }
  }

  /**
   * Devuelve una dupla (arreglo de dos valores) de arreglos.
   * Ejemplo de dupla de arreglos:
   * ```php
   * [
   *   ['primer', 'arreglo'],
   *   ['segundo', 'arreglo'],
   * ];
   * ```
   *
   * El primer elemento debe ser otro arreglo con la cantidad de veces que
   * salió cada número.
   * Ignorar las posiciones entre 0 y el valor mínimo del dado.
   * - Ejemplo con dado [1, 6]: [null, 1, 0, 3, 0, 1, 0]
   * - Ejemplo con dado [3, 5]: [null, null, null, 3, 5, 1]
   * - Ejemplo con dado [0, 4]: [1, 3, 5, 6]
   *
   * El segundo elemento debe ser otro arreglo con el valor de cada número
   * según la cantidad de veces multiplicado por el valor del número.
   * Ignorar las posiciones entre 0 y el valor mínimo del dado.
   * - Ejemplo con dado [1, 6]: [null, 1, 0, 9, 0, 5, 0]
   * - Ejemplo con dado [3, 5]: [null, null, null, 9, 20, 5]
   * - Ejemplo con dado [0, 4]: [0, 6, 15, 24]
   *
   * NOTA: Se recomienda tener un método privado para generar la estructura
   * del arreglo para el arreglo de valores y el de cantidades.
   */

  public function lanzarDados(): void
  {
    foreach ($this->dados as $dados) {
      $dados->rodar();
      $dados->reposar();
    }

    logger::info(modelo: $this, mensaje: ' Se lanzaron los dados ');
  }

  public function Resultado(): array
  {
    $valores = $this->construirArregloBase();
    $cantidades = $this->construirArregloBase();

    foreach ($this->dados as $dados) {
      $caravisible = $dados->caraVisible();

      $valores[$caravisible] = $valores[$caravisible] + 1;

      $cantidades[$caravisible] =
        $valores[$caravisible] * $cantidades[$caravisible];

      logger::info(
        mensaje: ' el numero  ' .
          $valores .
          'salio la  cantidades de veces ' .
          $cantidades,
      );
    }

    return [$valores, $cantidades];
  }
  private function construirArregloBase(): array
  {
    $arreglo = [];

    // 1. Seteo en null las posiciones a ignorar, que van
    // desde 0 al valor mínimo del dado.
    for ($i = 0; $i < $this->juego->dadoValorMin(); $i++) {
      $arreglo[$i] = null;
    }
    // 2. Lleno el resto del arreglo entre el valor mínimo
    // y el valor máximo con 0
    for (
      $i = $this->juego->dadoValorMin();
      $i <= $this->juego->dadoValorMax();
      $i++
    ) {
      $arreglo[$i] = 0;
    }

    return $arreglo;
  }
}
