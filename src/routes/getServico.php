<?php
require_once __DIR__ . '/../Model/ServicosModel.php';
if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $servicoModel = new ServicosModel();
    $servico = $servicoModel->buscarPorId($id);
    if($servico){
        echo json_encode($servico);
    } else {
        echo json_encode(['error' => 'Serviço não encontrado']);
    }
}