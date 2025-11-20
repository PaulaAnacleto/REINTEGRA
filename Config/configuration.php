<?php
// Define as constantes de conexão com o banco
// Ajuste estes valores para coincidir com a conexão que você usa no MySQL Workbench
// Ex.: Host 127.0.0.1, Porta 3306 (MySQL80) ou 3307 (XAMPP), Usuário e Senha conforme configurado

define('DB_HOST', 'localhost');      // Ou 'localhost'
define('DB_PORT', 3307);             // 3306 (MySQL padrão). Se usar XAMPP com porta 3307, mude para 3307

define('DB_USER', 'root');           // Usuário do MySQL
define('DB_PASS', '');               // SENHA do MySQL (mesma usada no Workbench)

define('DB_NAME', 'reintegra_db');   // Nome do banco de dados

define('DB_CHARSET', 'utf8mb4');
?>
