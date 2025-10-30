<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Criar Evento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">

  <div class="container my-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h3 class="mb-3 text-center">Criar Novo Evento</h3>
            
                                    <form action="Criar-evento.php" method="POST">
              <div class="mb-3">
                <label for="titulo" class="form-label">Título do Evento</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
              </div>

                            <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="data_inicio" class="form-label">Data de Início</label>
                  <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="data_fim" class="form-label">Data de Fim</label>
                  <input type="date" class="form-control" id="data_fim" name="data_fim" required>
                </div>
              </div>
              
                            <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="hora_inicio" class="form-label">Hora de Início</label>
                  <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="hora_fim" class="form-label">Hora de Fim</label>
                  <input type="time" class="form-control" id="hora_fim" name="hora_fim" required>
                </div>
              </div>
              
              <div class="mb-3">
                <label for="descricao" class="form-label">Descrição (Opcional)</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Salvar Evento</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>