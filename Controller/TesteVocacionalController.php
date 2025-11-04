<?php
require_once __DIR__ . '/../model/TesteVocacionalModel.php';

class TesteVocacionalController {
    private $model;

    public function __construct() {
        $this->model = new TesteVocacionalModel();
    }

    public function index() {
        require_once __DIR__ . '/../view/TesteVocacional.php';
    }

    public function dados() {
        header('Content-Type: application/json; charset=utf-8');

        if (isset($_GET['ia'])) {
            $area = htmlspecialchars($_GET['ia']);
            $score = (int)($_GET['score'] ?? 0);
            echo json_encode($this->model->getDicaIA($area, $score), JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode($this->model->getPerguntasEAreas(), JSON_UNESCAPED_UNICODE);
        }
    }
}
