
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reintegra - Eventos</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Templates/css/Agendador.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?..." rel="stylesheet">
<link rel="stylesheet" href="../Templates/css/Agendador.css">

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>

<style>
        #calendar-container {
            max-width: 825px;
            margin: 40px auto; /* Adiciona um espaço de 40px em cima e embaixo */
        }
    </style>

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
    <a class="navbar-brand" href="../View/Inicial-login.php">
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
  <div id="calendar-container"></div>
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
    // As variáveis são as mesmas
    const API_KEY = 'AIzaSyA8apmAyaF0c5mD2QONxV2PtHA5dJ18l6Y';
    const CALENDAR_ID = 'e9d55ddc0008700992e8636c307d0a940e9c6153ef8b1c59feee97b0530926ec@group.calendar.google.com';
    const timeMin = new Date().toISOString(); 
    const url = `https://www.googleapis.com/calendar/v3/calendars/${CALENDAR_ID}/events?key=${API_KEY}&timeMin=${timeMin}&orderBy=startTime&singleEvents=true`;

    // Espera o HTML carregar
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar-container');

        // Inicializa o FullCalendar
        const calendar = new FullCalendar.Calendar(calendarEl, {
            // Configurações básicas
            initialView: 'dayGridMonth', // Visão de Mês
            locale: 'pt-br', // Traduzir para Português-BR
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap5', // Usar o visual do Bootstrap 5

            // O MAIS IMPORTANTE: Buscar os eventos
            events: async function() {
                try {
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error('Erro ao buscar eventos da API');
                    }
                    const data = await response.json();
                    
                    // O FullCalendar precisa de { title, start, end }
                    // Nós vamos transformar a resposta do Google nesse formato
                    const aEventosFormatados = data.items.map(event => ({
                        title: event.summary, // Título do evento
                        start: event.start.dateTime || event.start.date, // Início
                        end: event.end.dateTime || event.end.date, // Fim
                        url: event.htmlLink, // Link para o Google Agenda (clicável!)
                        description: event.description // Descrição
                    }));
                    
                    return aEventosFormatados; // Retorna os eventos para o calendário

                } catch (error) {
                    console.error("Erro ao buscar eventos: ", error);
                    return []; // Retorna um array vazio em caso de erro
                }
            }
        });

        // "Desenha" o calendário na tela
        calendar.render();
    });
</script>


</body>
</html

