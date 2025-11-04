<?php
// Usamos este arquivo apenas para a estrutura HTML
// Toda a lógica CRUD será feita com JavaScript e Firestore
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Gerenciador de Cursos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Link para o mesmo CSS do seu Admin de calendário -->
    <link rel="stylesheet" href="../Templates/css/Criar_cursos.css"> 
</head>
<body class="admin-page">

  <div class="container my-5">
    <div class="row g-5">
            <!-- Coluna dos Formulários -->
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            
                        <!-- Formulário principal (muda dinamicamente) -->
            <h3 id="form-title" class="mb-3 text-center">Criar Novo Curso</h3>
            <form id="course-form">
                            <!-- Campo oculto para salvar o ID durante a edição -->
                            <input type="hidden" id="course-id">

              <div class="mb-3">
                <label for="titulo" class="form-label">Título do Curso</label>
                <input type="text" class="form-control" id="titulo" required>
              </div>
                            <div class="mb-3">
                <label for="link_externo" class="form-label">Link Externo (URL)</label>
                <input type="url" class="form-control" id="link_externo" placeholder="https://www.empresa.com/curso" required>
              </div>
              <div class="mb-3">
                <label for="descricao" class="form-label">Descrição Curta</label>
                <textarea class="form-control" id="descricao" rows="4" placeholder="Ex: Modelos de Negócios, Startups, Design Thinking..."></textarea>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" id="submit-button" class="btn btn-primary btn-lg">Salvar Novo Curso</button>
                                <button type="button" id="cancel-button" class="btn btn-secondary" style="display: none;">Cancelar Edição</button>
              </div>
            </form>
          </div>
        </div>
      </div>

            <!-- Coluna da Lista de Cursos -->
      <div class="col-md-7">
        <h2 class="mb-4">Cursos Cadastrados</h2>
                
                <!-- Mensagens de Sucesso ou Erro (controladas via JS) -->
                <div id="message-container"></div>
                
        <div class="card shadow-sm">
          <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th class="p-3">Título</th>
                  <th class="p-3">Link</th>
                  <th class="text-end p-3">Ações</th>
                </tr>
              </thead>
                            <!-- O conteúdo da tabela será preenchido pelo JavaScript -->
              <tbody id="courses-table-body">
                <tr>
                  <td colspan="3" class="text-center text-muted p-4">Carregando cursos...</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Scripts do Firebase (Importante!) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script type="module">
        // Importar funções do Firebase
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { 
            getAuth, 
            signInAnonymously, 
            signInWithCustomToken 
        } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { 
            getFirestore, 
            doc, 
            collection, 
            addDoc, 
            setDoc, 
            deleteDoc, 
            onSnapshot,
            query,
            getDoc
        } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // --- Configuração do Firebase ---
        // (As variáveis globais __app_id, __firebase_config, __initial_auth_token são injetadas pelo ambiente)
        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const firebaseConfig = JSON.parse(typeof __firebase_config !== 'undefined' ? __firebase_config : '{}');
        const authToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

        let db, auth, userId;
        let coursesCollection; // Referência da coleção

        // --- Elementos do DOM ---
        const form = document.getElementById('course-form');
        const formTitle = document.getElementById('form-title');
        const submitButton = document.getElementById('submit-button');
        const cancelButton = document.getElementById('cancel-button');
        const tableBody = document.getElementById('courses-table-body');
        const messageContainer = document.getElementById('message-container');

        // --- Funções de UI ---
        function showMessage(text, type = 'success') {
            const alertType = type === 'success' ? 'alert-success' : 'alert-danger';
            messageContainer.innerHTML = `<div class="alert ${alertType}">${text}</div>`;
            setTimeout(() => { messageContainer.innerHTML = ''; }, 3000);
        }

        function resetForm() {
            form.reset();
            document.getElementById('course-id').value = '';
            formTitle.textContent = 'Criar Novo Curso';
            submitButton.textContent = 'Salvar Novo Curso';
            cancelButton.style.display = 'none';
        }

        // --- Lógica CRUD (Firestore) ---

        // 1. READ (Ler e exibir Cursos)
        function listenForCourses() {
            const q = query(coursesCollection);
            onSnapshot(q, (snapshot) => {
                tableBody.innerHTML = ''; // Limpa a tabela
                if (snapshot.empty) {
                    tableBody.innerHTML = '<tr><td colspan="3" class="text-center text-muted p-4">Nenhum curso cadastrado.</td></tr>';
                    return;
                }
                snapshot.forEach((doc) => {
                    const course = doc.data();
                    const courseId = doc.id;
                    const tr = document.createElement('tr');
                    
                    // Limita o link para exibição
                    const shortLink = course.link_externo.length > 30 ? course.link_externo.substring(0, 30) + '...' : course.link_externo;

                    tr.innerHTML = `
                        <td class="p-3"><strong>${course.titulo}</strong></td>
                        <td class="p-3"><a href="${course.link_externo}" target="_blank">${shortLink}</a></td>
                        <td class="text-end p-3">
                            <button class="btn btn-sm btn-outline-secondary me-2 btn-edit" data-id="${courseId}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger btn-delete" data-id="${courseId}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    `;
                    tableBody.appendChild(tr);
                });
            }, (error) => {
                console.error("Erro ao buscar cursos: ", error);
                showMessage("Erro ao carregar os cursos.", "danger");
            });
        }

        // 2. CREATE / UPDATE (Criar ou Atualizar)
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const cursoId = document.getElementById('course-id').value;
            const titulo = document.getElementById('titulo').value;
            const link_externo = document.getElementById('link_externo').value;
            const descricao = document.getElementById('descricao').value;

            const cursoData = { titulo, link_externo, descricao };

            try {
                if (cursoId) {
                    // --- UPDATE (Atualizar) ---
                    const courseDoc = doc(db, coursesCollection.path, cursoId);
                    await setDoc(courseDoc, cursoData);
                    showMessage('Curso atualizado com sucesso!');
                } else {
                    // --- CREATE (Criar) ---
                    await addDoc(coursesCollection, cursoData);
                    showMessage('Curso criado com sucesso!');
                }
                resetForm();
            } catch (error) {
                console.error("Erro ao salvar curso: ", error);
                showMessage("Erro ao salvar o curso.", "danger");
            }
        });

        // 3. Funções dos botões (Editar e Excluir)
        tableBody.addEventListener('click', async (e) => {
            const target = e.target.closest('button');
            if (!target) return;

            const id = target.dataset.id;

            // --- DELETE (Excluir) ---
            if (target.classList.contains('btn-delete')) {
                if (confirm('Tem certeza que deseja excluir este curso?')) {
                    try {
                        const courseDoc = doc(db, coursesCollection.path, id);
                        await deleteDoc(courseDoc);
                        showMessage('Curso excluído com sucesso!');
                    } catch (error) {
                        console.error("Erro ao excluir curso: ", error);
                        showMessage("Erro ao excluir o curso.", "danger");
                    }
                }
            }
            
            // --- EDIT (Carregar dados para Editar) ---
            if (target.classList.contains('btn-edit')) {
                try {
                    const courseDoc = doc(db, coursesCollection.path, id);
                    const docSnap = await getDoc(courseDoc);
                    if (docSnap.exists()) {
                        const course = docSnap.data();
                        document.getElementById('course-id').value = id;
                        document.getElementById('titulo').value = course.titulo;
                        document.getElementById('link_externo').value = course.link_externo;
                        document.getElementById('descricao').value = course.descricao;
                        
                        formTitle.textContent = 'Editar Curso';
                        submitButton.textContent = 'Salvar Alterações';
                        cancelButton.style.display = 'block';
                        window.scrollTo(0, 0); // Rola para o topo
                    }
                } catch (error) {
                    console.error("Erro ao carregar curso para edição: ", error);
                    showMessage("Erro ao carregar o curso.", "danger");
                }
            }
        });
        
        // Botão Cancelar Edição
        cancelButton.addEventListener('click', resetForm);

        // --- Inicialização ---
        async function init() {
            try {
                const app = initializeApp(firebaseConfig);
                db = getFirestore(app);
                auth = getAuth(app);

                // Autenticação
                if (authToken) {
                    await signInWithCustomToken(auth, authToken);
                } else {
                    await signInAnonymously(auth);
                }
                
                userId = auth.currentUser ? auth.currentUser.uid : 'anonymous';
                
                // Definir a coleção (usando o caminho público)
                const collectionPath = `artifacts/${appId}/public/data/cursos`;
                coursesCollection = collection(db, collectionPath);
                
                // Começar a "ouvir" por mudanças nos cursos
                listenForCourses();
                
            } catch (error) {
                console.error("Erro na inicialização do Firebase: ", error);
                tableBody.innerHTML = '<tr><td colspan="3" class="text-center text-danger p-4">Erro ao conectar com o banco de dados.</td></tr>';
            }
        }

        init();
    </script>
</body>
</html>
