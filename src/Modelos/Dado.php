<?php

namespace Raiz\Modelos;

use Raiz\Utilidades\Logger;

class Dado extends ModeloBase
{
  public const INICIAL = 'inicial';
  public const EN_REPOSO = 'en_reposo';
  public const RODANDO = 'rodando';
  private int $valorMinimo;
  private int $valorMaximo;
  private int $caraVisible;
  private string $estado;

  function __construct(?string $id = null, int $valorMinimo, int $valorMaximo)
  {
    parent::__construct($id);

    $this->id = $id;
    $this->valorMaximo = $valorMaximo;
    $this->valorMinimo = $valorMinimo;
    $this->caraVisible = -1;
    $this->estado = self::INICIAL;
  }
  public function estado(): string
  {
    return $this->estado;
  }

  public function rodar(): void
  {
    Logger::info(modelo: $this, mensaje: 'RODANDO');
    $this->estado = self::RODANDO;
  }

  public function reposar(): void
  {
    if ($this->estado === self::EN_REPOSO) {
      throw new DadoEstadoError(
        dado: $this,
        codigo: DadoEstadoError::INTENTAR_REPOSAR_EN_REPOSO,
      );
    } else {
      $this->caraVisible = random_int(
        min: $this->valorMinimo,
        max: $this->valorMaximo,
      );
      $this->estado = self::EN_REPOSO;
    }
  }

  public function caraVisible()
  {
    if ($this->estado === self::RODANDO) {
      throw new DadoEstadoError(
        dado: $this,
        codigo: DadoEstadoError::INTENTAR_LEER_MIENTRAS_RUEDA,
      );
    } else {
      return $this->caraVisible;
    }
  }
}
