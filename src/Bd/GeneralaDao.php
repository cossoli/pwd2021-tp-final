<?php
namespace Raiz\Bd;
use Raiz\Bd\DaoInterface;

use Raiz\Bd\ConexionBd;
use Raiz\Modelos\Jugador;
use Raiz\Modelos\ModeloBase;
use Raiz\Auxiliadores\Serializador;

class GeneralaDao implements DaoInterface
{
  public static function listar(): array
  {
    $sql =
      "SELECT id,nombre DATE_FORMAT(ingreso,'%Y-%m-%dT%T') ingreso  * FROM  jugadores ;";

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
      params: [],
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
      params: [],
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
    $sql = 'INSERT INTO `jugadores` VALUES (:id, :nombre, :ingreso);';
  }

  public static function borrar(string $id): void
  {
    $sql = 'SELECT * FROM jugadores WHERE id := id;';
  }
}
