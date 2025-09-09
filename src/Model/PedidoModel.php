<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/ServicosModel.php';
class PedidoModel
{
    private int $id;

    private int $id_usuario;

    private int $id_servico;

    private $db;

    public function __construct(int $id_usuario, int $id_servico, $db)
    {
        $this->id_usuario = $id_usuario;
        $this->id_servico = $id_servico;
       $this->db->getConnection();
    }

}