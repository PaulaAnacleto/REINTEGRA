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

   // --- FUNÇÃO PARA CARREGAR OS DADOS DO USUÁRIO (COM CORREÇÃO DA DATA) ---
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
        
        // --- CORREÇÃO AQUI ---
        // Transforma '0000-00-00' (inválido para o HTML) em string vazia
          dataNascimento.value = (data.dataNascimento === '0000-00-00' ? '' : data.dataNascimento) || '';
        // --- FIM DA CORREÇÃO ---

          cpf.value = data.cpf || '';
          profissao.value = data.profissao || '';
          userName.textContent = data.nomeCompleto || 'Usuário';
          profileUserName.textContent = data.nomeCompleto || 'Usuário';
          profileUserEmail.textContent = data.email || 'Email';
          originalData = {
             nomeCompleto: data.nomeCompleto || '',
             email: data.email || '',
             dataNascimento: (data.dataNascimento === '0000-00-00' ? '' : data.dataNascimento) || '',
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

// --- INÍCIO DAS FUNÇÕES QUE ESTAVAM FALTANDO ---

// Funções de Validação (copiadas da sua versão robusta)
function validateEmail(email) {
   const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
   return emailRegex.test(email);
}

function validateCPF(cpf) {
   const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
   return cpfRegex.test(cpf);
}

function validateBirthDate(date) {
     if (!date) return false; 
   const birthDate = new Date(date);
   const today = new Date();
   let age = today.getFullYear() - birthDate.getUTCFullYear();
   const m = today.getUTCMonth() - birthDate.getUTCMonth();
   if (m < 0 || (m === 0 && today.getUTCDate() < birthDate.getUTCDate())) {
     age--;
   }
   return age >= 16 && age <= 100;
}

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
  // O perfil pode ter campos opcionais, mas o seu JS era estrito.
  // Vamos manter a validação estrita que você criou.
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

// Funções de UI (copiadas da sua versão robusta)
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

function cancelEdit() {
   // Restaurar dados originais
   nomeCompleto.value = originalData.nomeCompleto;
   email.value = originalData.email;
   dataNascimento.value = originalData.dataNascimento;
   cpf.value = originalData.cpf;
   profissao.value = originalData.profissao;
  
   exitEditMode();
   console.log('Edição cancelada, dados restaurados');
}

// --- FIM DAS FUNÇÕES QUE ESTAVAM FALTANDO ---


// --- FUNÇÃO PARA SALVAR ALTERAÇÕES (Já estava correta) ---
async function saveChanges() {
  if (!validateForm()) {
   return; // Para a execução se o formulário for inválido
  }

  // Mostrar loading
  saveBtn.classList.add('loading');
  saveBtn.textContent = 'Salvando...';
  saveBtn.disabled = true; 

  const formData = new FormData(profileForm);
  formData.append('action', 'update_profile'); 

  try {
    const response = await fetch('../Controller/UserController.php', {
       method: 'POST',
       body: formData
    });
    const result = await response.json();

    if (result.success) {
       alert(result.message); 
       
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
    // Remove o loading
    saveBtn.classList.remove('loading');
    saveBtn.textContent = 'Salvar Alterações';
    saveBtn.disabled = false;
}
}

// --- Event Listeners (Gatilhos) ---
// (Estes listeners agora encontrarão as funções que eles chamam)
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