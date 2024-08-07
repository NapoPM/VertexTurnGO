<?php

namespace Model;


class Categorias extends ActiveRecord {
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }

    //Trae las categorias
    public static function obtenerTodos() {
        $query = "SELECT * FROM " . self::$tabla;
        $resultado = self::$db->query($query);

        $categorias = [];
        while ($row = $resultado->fetch_assoc()) {
            $categorias[] = new self($row);
        }

        return $categorias;
    }
}