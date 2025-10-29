
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reintegra - Reintegrando sua vida por completo</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Templates/css/Agendador.css">
</head>
<body>



    <div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
  new window.VLibras.Widget('https://vlibras.gov.br/app' );
</script>
    
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">
      <div class="logo-box">
        <span class="logo-text">REINTEGRA</span>
      </div>
    </a>

    <!-- Perfil + botão hamburguer (visível apenas no mobile) -->
    <div class="d-flex align-items-center">
      <a href="../View/Perfil.php" class="d-lg-none me-2">
        <button class="btn-perfil">
          <img src="../Img/página de perfil/icone perfil.png" class="img-perfil" alt="Perfil">
        </button>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="../view/Servicos">Serviços</a></li>
        <li class="nav-item"><a class="nav-link" href="#cadastro">Feedback</a></li>
        <li class="nav-item"><a class="nav-link" href="../View/Contato.php">Contato</a></li>
        <li class="nav-item"><a class="nav-link" href="#sobre">Sobre</a></li>
        <li class="nav-item"><a class="nav-link" href="../View/Inicial-login.php">Início</a></li>

        <!-- Perfil visível apenas no desktop -->
        <li class="nav-item d-none d-lg-block">
          <a href="../View/Perfil.php">
            <button class="btn-perfil">
              <img src="../Img/página de perfil/icone perfil.png" class="img-perfil" alt="Perfil">
            </button>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>


    <!-- Hero Section -->

    <div class="container my-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <h2 class="mb-4">Próximos Eventos</h2>
      
      <ul id="event-list" class="list-group shadow-sm">
        <li class="list-group-item text-center">Carregando eventos...</li>
      </ul>
      
    </div>
  </div>
</div>


    <!-- Footer -->
 <!-- Footer Section -->
        <footer class="footer">
           
            <div class="footer-links">
                  <p class="footer-text">
                © 2025 Reintegra. Todos os direitos reservados.
            </p>
                <a href="../View/Politca-privacidade" class="footer-link">Política de Privacidade</a>
                <a href="../View/Termos-servico" class="footer-link">Termos de Serviço</a>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="../Templates/js/Agendador.js"></script>






<script>
    // --- SUAS INFORMAÇÕES PREENCHIDAS ---
    const API_KEY = 'AIzaSyA8apmAyaF0c5mD2QONxV2PtHA5dJ18l6Y';
    const CALENDAR_ID = 'e9d55ddc0008700992e8636c307d0a940e9c6153ef8b1c59feee97b0530926ec@group.calendar.google.com';
    // ----------------------------------------

    // Parâmetros para buscar eventos futuros, ordenados por início
    const timeMin = new Date().toISOString(); 
    const params = `?key=${API_KEY}&timeMin=${timeMin}&orderBy=startTime&singleEvents=true`;

    const url = `https://www.googleapis.com/calendar/v3/calendars/${CALENDAR_ID}/events${params}`;

    /**
     * Busca os eventos do Google Calendar e os exibe na página.
     */
    async function fetchEvents() {
      // Encontra o elemento da lista no seu HTML (lembre-se de criar este ul)
      const eventList = document.getElementById('event-list');
      
      if (!eventList) {
        console.error('Elemento #event-list não encontrado na página.');
        return;
      }

      try {
        const response = await fetch(url);
        if (!response.ok) {
          // Se a API retornar um erro (ex: Chave inválida, Calendário não é público)
          const errorData = await response.json();
          console.error('Erro da API do Google:', errorData.error.message);
          throw new Error(`Erro ao buscar eventos (${response.status})`);
        }
        
        const data = await response.json();
        
        eventList.innerHTML = ''; // Limpar "Carregando..."
        
        if (data.items && data.items.length > 0) {
          // Loop para cada evento encontrado
          data.items.forEach(event => {
            const eventElement = document.createElement('li');
            
            // Formata a data para ficar mais legível (ex: 29/10/2025, 11:30:00)
            const startTime = new Date(event.start.dateTime || event.start.date).toLocaleString('pt-BR');
            
            eventElement.textContent = `${startTime} - ${event.summary}`;
            eventList.appendChild(eventElement);
          });
        } else {
          eventList.textContent = 'Nenhum evento futuro encontrado.';
        }

      } catch (error) {
        console.error('Erro no fetchEvents:', error);
        if (eventList) {
          eventList.textContent = 'Não foi possível carregar os eventos. Verifique o console para mais detalhes.';
        }
      }
    }

    // Chamar a função para carregar os eventos quando a página abrir
    // Adicionamos 'DOMContentLoaded' para garantir que o HTML (incluindo #event-list) 
    // já foi carregado antes do script rodar.
    document.addEventListener('DOMContentLoaded', fetchEvents);
</script>



</body>
</html

