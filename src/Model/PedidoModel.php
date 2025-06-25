<?php

namespace App\Model;
use App\Db\Db;

class PedidoModel
{
    private $db;
    
    public function __construct()
    {
        session_start();

        $this->db = new Db();
    }
    
    public function criarPedido(string $idcliente): int
    {
        $success = $this->db->insert("ped_idcliente", "'$idcliente'", "pedidos");
        if($success) {
            return true;
        }
        return false;
    }
    
    public function adicionarItem(int $pedidoId, array $item): bool
    {

        $success = $this->db->insert("itvd_idpedidos,itvd_idprodutos, itvd_qte,itvd_valor", "'$pedidoId' ,'$item[itvd_idprodutos]','$item[itvd_qte]','$item[itvd_valor]'", "item_venda");
        if($success) {
            return true;
        }
        return false;
    }
}