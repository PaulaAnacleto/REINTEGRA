// Aguarda o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function() {

 //Botão voltar
 const backButton = document.querySelector('.back-button');
 
 if (backButton) {
  backButton.addEventListener('click', function() {
   if (window.history.length > 1) {
    window.history.back();
   } else {
    window.location.href = '../View/inicial-login.php';
   }
  });
 }
 
 // Elementos da página
 const profileForm = document.getElementById('profileForm');
 const editBtn = document.getElementById('editBtn');
 const saveBtn = document.getElementById('saveBtn');
 const cancelBtn = document.getElementById('cancelBtn');
 
 // Campos do formulário
 const formInputs = document.querySelectorAll('.form-input');
 const nomeCompleto = document.getElementById('nomeCompleto');
 const email = document.getElementById('email');
 const dataNascimento = document.getElementById('dataNascimento');
 const cpf = document.getElementById('cpf');
 const profissao = document.getElementById('profissao');
 
 // Elementos de exibição do nome
 const userName = document.getElementById('userName');
 const profileUserName = document.getElementById('profileUserName');
 const profileUserEmail = document.getElementById('profileUserEmail');

 // Dados originais para cancelamento
 let originalData = {};
 let isEditing = false;

    // --- NOVO: FUNÇÃO PARA CARREGAR OS DADOS DO USUÁRIO ---
    async function loadUserData() {
        try {
            // Faz um GET para o Controller (o Controller sabe quem está logado pela sessão)
            const response = await fetch('../Controller/UserController.php', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            });
            
            const result = await response.json();

            if (result.success && result.data) {
                const data = result.data;
                
                // Preenche os campos do formulário
                nomeCompleto.value = data.nomeCompleto || '';
                email.value = data.email || '';
                dataNascimento.value = data.dataNascimento || '';
                cpf.value = data.cpf || '';
                profissao.value = data.profissao || '';
                
                // Preenche os 'spans' e 'h3'
                userName.textContent = data.nomeCompleto || 'Usuário';
                profileUserName.textContent = data.nomeCompleto || 'Usuário';
                profileUserEmail.textContent = data.email || 'Email';

                // --- IMPORTANTE: Salva os dados originais para o "Cancelar" ---
                originalData = {
                    nomeCompleto: data.nomeCompleto || '',
                    email: data.email || '',
                    dataNascimento: data.dataNascimento || '',
                    cpf: data.cpf || '',
                    profissao: data.profissao || ''
                };
            } else {
                alert('Erro ao carregar dados: ' + result.message);
                // Se falhar, talvez redirecione para o login
                if (!result.success && result.message.includes('autenticado')) {
                     window.location.href = 'login.php'; // Ajuste o caminho
                }
            }
        } catch (error) {
            console.error('Erro na requisição:', error);
            alert('Não foi possível conectar ao servidor para carregar seus dados.');
        }
    }

 // Função para validar email
 function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
 }

 // Função para validar CPF (formato básico)
 function validateCPF(cpf) {
  const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
  return cpfRegex.test(cpf);
 }

 // Função para validar data de nascimento
 function validateBirthDate(date) {
        if (!date) return false; // Verifica se a data não está vazia
  const birthDate = new Date(date);
  const today = new Date();
        // Ajuste para pegar o ano certo e evitar problemas de fuso
        let age = today.getFullYear() - birthDate.getUTCFullYear();
        const m = today.getUTCMonth() - birthDate.getUTCMonth();
        if (m < 0 || (m === 0 && today.getUTCDate() < birthDate.getUTCDate())) {
            age--;
        }
  return age >= 16 && age <= 100;
 }

 // Função para validar formulário
 function validateForm() {
  let isValid = true;
  const errors = [];

  if (!nomeCompleto.value.trim() || nomeCompleto.value.trim().length < 2) {
   errors.push('Nome completo deve ter pelo menos 2 caracteres');
   isValid = false;
  }
  if (!validateEmail(email.value.trim())) {
   errors.push('Email deve ter um formato válido');
   isValid = false;
  }
  if (!validateBirthDate(dataNascimento.value)) {
   errors.push('Data de nascimento deve ser válida (idade entre 16 e 100 anos)');
   isValid = false;
  }
  if (!validateCPF(cpf.value.trim())) {
   errors.push('CPF deve estar no formato XXX.XXX.XXX-XX');
   isValid = false;
  }
  if (!profissao.value.trim() || profissao.value.trim().length < 2) {
   errors.push('Profissão deve ter pelo menos 2 caracteres');
   isValid = false;
  }

  if (!isValid) {
   alert('Erros encontrados:\n\n' + errors.join('\n'));
  }
  return isValid;
 }

 // Função para entrar no modo de edição
 function enterEditMode() {
  isEditing = true;
  
  formInputs.forEach(input => {
   input.removeAttribute('readonly');
   input.classList.add('editing');
  });
  
  editBtn.style.display = 'none';
  saveBtn.style.display = 'flex';
  cancelBtn.style.display = 'flex';
  nomeCompleto.focus();
 }

 // Função para sair do modo de edição
 function exitEditMode() {
  isEditing = false;
  
  formInputs.forEach(input => {
   input.setAttribute('readonly', true);
   input.classList.remove('editing');
  });
  
  editBtn.style.display = 'flex';
  saveBtn.style.display = 'none';
  cancelBtn.style.display = 'none';
 }

 // Função para cancelar edição
 function cancelEdit() {
  // Restaurar dados originais (agora funciona!)
  nomeCompleto.value = originalData.nomeCompleto;
  email.value = originalData.email;
  dataNascimento.value = originalData.dataNascimento;
  cpf.value = originalData.cpf;
  profissao.value = originalData.profissao;
  
  exitEditMode();
  console.log('Edição cancelada, dados restaurados');
 }

 // --- NOVO: FUNÇÃO PARA SALVAR ALTERAÇÕES (COMPLETA) ---
 async function saveChanges() {
  if (!validateForm()) {
   return; // Para a execução se o formulário for inválido
  }

  // Mostrar loading
  saveBtn.classList.add('loading');
  saveBtn.textContent = 'Salvando...';
        saveBtn.disabled = true; // Desabilita o botão

        // Cria um objeto FormData com os dados do formulário
        const formData = new FormData(profileForm);

        try {
            // Envia os dados como POST para o Controller
            const response = await fetch('../Controller/UserController.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                alert(result.message); // "Perfil atualizado com sucesso!"
                
                // Atualiza os dados originais para o novo estado
                originalData = { ...result.data }; 
                
                // Atualiza os cabeçalhos da página
                userName.textContent = result.data.nomeCompleto;
                profileUserName.textContent = result.data.nomeCompleto;
                profileUserEmail.textContent = result.data.email;
                
                // Sai do modo de edição
                exitEditMode();
            } else {
                // Mostra a mensagem de erro vinda do PHP (ex: "Email já em uso")
                alert('Erro ao salvar: ' + result.message);
            }

        } catch (error) {
            console.error('Erro na requisição:', error);
            alert('Não foi possível conectar ao servidor para salvar os dados.');
        } finally {
            // Remove o loading, independente de sucesso ou falha
            saveBtn.classList.remove('loading');
            saveBtn.textContent = 'Salvar Alterações';
            saveBtn.disabled = false;
        }
 }

 // --- Event Listeners ---
 editBtn.addEventListener('click', enterEditMode);
 saveBtn.addEventListener('click', saveChanges); // MUDANÇA: 'click' é mais direto aqui
 cancelBtn.addEventListener('click', cancelEdit);

 profileForm.addEventListener('submit', function(e) {
  e.preventDefault(); // Previne o envio padrão do formulário
  if (isEditing) {
            // saveChanges(); // Não precisamos mais, o botão saveBtn já faz isso
  }
 });

 // Formatação automática do CPF
 cpf.addEventListener('input', function() {
  if (!isEditing) return;
  
  let value = this.value.replace(/\D/g, '');
        if (value.length > 11) value = value.substring(0, 11); // Limita a 11 dígitos
  value = value.replace(/(\d{3})(\d)/, '$1.$2');
  value = value.replace(/(\d{3})(\d)/, '$1.$2');
  value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
  this.value = value;
 });
  
    // (Você pode adicionar sua função animatePageLoad aqui se a tiver)
 // setTimeout(animatePageLoad, 200);

 // --- Inicialização ---
    // Chama a função para carregar os dados assim que a página abrir
 loadUserData(); 
 
 console.log('Página de perfil REINTEGRA inicializada com sucesso!');
});