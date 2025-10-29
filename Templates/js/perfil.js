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

  // --- FUNÇÃO PARA CARREGAR OS DADOS DO USUÁRIO (Já estava correta) ---
  async function loadUserData() {
    try {
      const response = await fetch('../Controller/UserController.php', {
        method: 'GET',
        headers: { 'Accept': 'application/json' }
      });
      const result = await response.json();
      if (result.success && result.data) {
        const data = result.data;
        nomeCompleto.value = data.nomeCompleto || '';
        email.value = data.email || '';
        dataNascimento.value = data.dataNascimento || '';
        cpf.value = data.cpf || '';
        profissao.value = data.profissao || '';
        userName.textContent = data.nomeCompleto || 'Usuário';
        profileUserName.textContent = data.nomeCompleto || 'Usuário';
        profileUserEmail.textContent = data.email || 'Email';
        originalData = {
          nomeCompleto: data.nomeCompleto || '',
          email: data.email || '',
          dataNascimento: data.dataNascimento || '',
          cpf: data.cpf || '',
          profissao: data.profissao || ''
        };
      } else {
        alert('Erro ao carregar dados: ' + result.message);
        if (result.message && result.message.includes('autenticado')) {
          window.location.href = 'login.php'; 
        }
      }
    } catch (error) {
      console.error('Erro na requisição:', error);
      alert('Não foi possível conectar ao servidor para carregar seus dados.');
    }
  }

// (Suas funções de validação: validateEmail, validateCPF, validateBirthDate, validateForm)
 // ... Elas permanecem exatamente iguais ...
function validateEmail(email) { /* ... seu código ... */ }
function validateCPF(cpf) { /* ... seu código ... */ }
function validateBirthDate(date) { /* ... seu código ... */ }
function validateForm() { /* ... seu código ... */ }

// (Suas funções de UI: enterEditMode, exitEditMode, cancelEdit)
 // ... Elas permanecem exatamente iguais ...
function enterEditMode() { /* ... seu código ... */ }
function exitEditMode() { /* ... seu código ... */ }
function cancelEdit() { /* ... seu código ... */ }

// --- INÍCIO DA PARTE MESCLADA: FUNÇÃO PARA SALVAR ALTERAÇÕES ---
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

    // --- LINHA CRÍTICA ADICIONADA AQUI ---
    formData.append('action', 'update_profile'); 
    // --- FIM DA LINHA ADICIONADA ---

 try {
   const response = await fetch('../Controller/UserController.php', {
     method: 'POST',
     body: formData
   });

   const result = await response.json();

   if (result.success) {
     alert(result.message); // "Perfil atualizado com sucesso!"
     
            // Atualiza os dados originais com base no que foi salvo
     originalData = {
                nomeCompleto: nomeCompleto.value,
                email: email.value,
                dataNascimento: dataNascimento.value,
                cpf: cpf.value,
                profissao: profissao.value
            }; 
     
     // Atualiza os cabeçalhos da página
     userName.textContent = nomeCompleto.value;
     profileUserName.textContent = nomeCompleto.value;
     profileUserEmail.textContent = email.value;
     
     exitEditMode();
   } else {
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
  // --- FIM DA PARTE MESCLADA ---

// --- Event Listeners (Já estavam corretos) ---
editBtn.addEventListener('click', enterEditMode);
saveBtn.addEventListener('click', saveChanges); 
cancelBtn.addEventListener('click', cancelEdit);

profileForm.addEventListener('submit', function(e) {
  e.preventDefault(); 
});

// Formatação automática do CPF (Já estava correta)
cpf.addEventListener('input', function() {
  if (!isEditing) return;
   let value = this.value.replace(/\D/g, '');
  if (value.length > 11) value = value.substring(0, 11);
  value = value.replace(/(\d{3})(\d)/, '$1.$2');
  value = value.replace(/(\d{3})(\d)/, '$1.$2');
  value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
  this.value = value;
});
 
// --- Inicialização ---
loadUserData(); 

console.log('Página de perfil REINTEGRA inicializada com sucesso!');
});