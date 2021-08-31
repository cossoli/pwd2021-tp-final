<?php

namespace Raiz\Modelos;

use Error;

class DadoEstadoError extends Error
{
  public const INTENTAR_LEER_MIENTRAS_RUEDA = 115;
  public const INTENTAR_REPOSAR_EN_REPOSO = 125;
  private const ERROR_DESCONOCIDO = -1;

  public function __construct(Dado $dado, int $codigo)
  {
    switch ($codigo) {
      case self::INTENTAR_LEER_MIENTRAS_RUEDA:
        parent::__construct(
          message: "Se intentó leer el dado#{$dado->id()} mientras estaba rodando.",
          code: self::INTENTAR_LEER_MIENTRAS_RUEDA,
        );
        break;
      case self::INTENTAR_REPOSAR_EN_REPOSO:
        parent::__construct(
          message: "Se intentó reposar el dado#{$dado->id()} actualmente en reposo.",
          code: self::INTENTAR_REPOSAR_EN_REPOSO,
        );
        break;
      default:
        parent::__construct(
          message: "Acción {{$codigo}} desconocida.",
          code: self::ERROR_DESCONOCIDO,
        );
        break;
    }
  }
}
