<?php

namespace Raiz\Modelos;

use Brick\DateTime\LocalDateTime;
use Raiz\Auxiliadores\FechaHora;

use phpDocumentor\Reflection\PseudoTypes\True_;
use Raiz\Modelos\Cubilete;
use Raiz\Utilidades\Logger;
use Raiz\Auxiliadores\Serializador;
use Serializable;

class Jugador extends ModeloBase implements Serializador
{

  private string $nombre;
  private LocalDateTime $ingreso;

  public function __construct(
    ?string $id = null,
    string $nombre,
    ?string $ingreso = null,


  ) {

    $this->id = is_null($id) ? 'adjhdf' : $id;
    $this->nombre = $nombre;
    $this->ingreso = is_null($ingreso) ?: FechaHora::deserializar($ingreso);

    parent::__construct($id);

  }
  public function nombre()
  {
    return $this->nombre;
  }

  public function realizarTurno(Cubilete $cubilete)
  {
    Logger::info(modelo: $this, mensaje: 'Jugador Empezo Turno ');
  }
  public function serializar(): array
  {
    return [
      'id' => $this->id,
      'nombre' => $this->nombre,
      'ingreso' => $this->ingreso,
    ];
  }
  public static function deserializar(array $datos): self
  {
    return new self(
      id: $datos['id'],
      nombre: $datos['nombre'],
      ingreso: $datos['ingreso'],
    );
  }
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }
}
