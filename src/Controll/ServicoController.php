<?php
require_once __DIR__ . '/../Model/Database.php';
require_once __DIR__ . '/../Model/ServicosModel.php';

session_start();


class ServicoController
{

    private $db;
    private $servicoModel;

    public function __construct($servicoModel)
    {
        $this->servicoModel = $servicoModel;
        $this->db = new Database();
    }

    public function cadstrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $descricao = $_POST['descricao'];
            $servico = new ServicosModel($nome, $preco, $descricao);
            $servico->cadstrarServico();

            if (empty($nome)) {
                $_SESSION['mnsCadastroErro'] = "O nome do serviço é obrigatório.";
            }
            if (empty($preco) || !is_numeric($preco) || $preco <= 0) {
                $_SESSION['mnsCadastroErro'] = "O preço do serviço deve ser um número maior que zero.";
            }
        }
    }

    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $descricao = $_POST['descricao'];
            $servico = new ServicosModel($nome, $preco, $descricao);
            $servico->editarServico($id, $nome, $preco, $descricao);
            if (empty($nome)) {
                $_SESSION['mnsCadastroErro'] = "O nome do serviço é obrigatório.";
            }
            if (empty($preco) || !is_numeric($preco) || $preco <= 0) {
                $_SESSION['mnsCadastroErro'] = "O preço do serviço deve ser um número maior que zero.";
            }


        }

    }

    public function deletar($id)
    {
        $servico = new ServicosModel(0, '', '');
        $servico->deletarServico($id);
    }

}