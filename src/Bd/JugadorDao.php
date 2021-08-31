<?php

namespace Raiz\Bd;

use phpDocumentor\Reflection\Types\Null_;
use Raiz\Auxiliadores\Serializador;
use Raiz\Bd\DaoInterface;
use Raiz\Bd\ConexionBd;
use Raiz\Modelos\Jugador;
use Raiz\Modelos\ModeloBase;

class JugadorDao implements DaoInterface
{
  public static function listar(): array
  {
    $sql = 'SELECT * FROM  jugadores ';
    $listaDeJugadores = ConexionBd::leer(
      sql: $sql,
      transformador: function (\PDOStatement $listaDeJugadores) {
        return $listaDeJugadores->fetchAll(\PDO::FETCH_ASSOC);
      },
    );

    $jugadores = [];

    foreach ($listaDeJugadores as $Jugador) {
      $jugadores[] = Jugador::deserializar($Jugador);
    }
    return $jugadores;
  }

  public static function buscarPorId(string $id): ?ModeloBase
  {
    $sql = 'SELECT * FROM jugadores WHERE id := id;';
    $buscajugador = ConexionBd::leer(
      sql: $sql,
      transformador: function (\PDOStatement $consulta) {
        return $consulta->fetchAll(\PDO::FETCH_ASSOC);
      },
    );
    if ($buscajugador) {
      return Jugador::deserializar($buscajugador);
    } else {
      return null;
    }
  }
  public static function persistir(Serializador $instancia): void
  {
    $sql = 'SELECT id, ingreso, nombre FROM jugadores;';
    $persistirjugador = ConexionBd::leer(
      sql: $sql,
      transformador: function (\PDOStatement $persistirjugador) {
        $datos = $persistirjugador->fetchAll(\PDO::FETCH_ASSOC);

        $jugadores = [];

        foreach ($datos as $datosDeUnJugadorEnParticular) {
          array_push(
            $jugadores,
            Jugador::deserializar($datosDeUnJugadorEnParticular),
          );
        }
      },
    );
  }

  public static function actualizar(Serializador $instancia): void
  {
    $sql = 'SELECT * FROM jugadores WHERE id := id;';
  }

  public static function borrar(string $id): void
  {
    $sql = 'SELECT * FROM jugadores WHERE id := id;';
  }
}
