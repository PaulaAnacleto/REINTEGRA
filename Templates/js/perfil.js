// Aguarda o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function() {

    //Botão voltar
     const backButton = document.querySelector('.back-button');
    
    if (backButton) {
        backButton.addEventListener('click', function() {
            // Verifica se há histórico de navegação
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // Se não houver histórico, redireciona para a página inicial
                window.location.href = '../View/inicial-login.php';
            }
        });
    }
    
    // Elementos da página
    const profileForm = document.getElementById('profileForm');
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const backBtn = document.querySelector('.back-btn');
    const actionCards = document.querySelectorAll('.action-card');
    
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
        const birthDate = new Date(date);
        const today = new Date();
        const age = today.getFullYear() - birthDate.getFullYear();
        return age >= 16 && age <= 100;
    }

    // Função para validar formulário
    function validateForm() {
        let isValid = true;
        const errors = [];

        // Validar nome completo
        if (!nomeCompleto.value.trim() || nomeCompleto.value.trim().length < 2) {
            errors.push('Nome completo deve ter pelo menos 2 caracteres');
            isValid = false;
        }

        // Validar email
        if (!validateEmail(email.value.trim())) {
            errors.push('Email deve ter um formato válido');
            isValid = false;
        }

        // Validar data de nascimento
        if (!validateBirthDate(dataNascimento.value)) {
            errors.push('Data de nascimento deve ser válida (idade entre 16 e 100 anos)');
            isValid = false;
        }

        // Validar CPF
        if (!validateCPF(cpf.value.trim())) {
            errors.push('CPF deve estar no formato XXX.XXX.XXX-XX');
            isValid = false;
        }

        // Validar profissão
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
        
        // Remover readonly dos campos
        formInputs.forEach(input => {
            input.removeAttribute('readonly');
            input.classList.add('editing');
        });
        
        // Alterar visibilidade dos botões
        editBtn.style.display = 'none';
        saveBtn.style.display = 'flex';
        cancelBtn.style.display = 'flex';
        
        // Focar no primeiro campo
        nomeCompleto.focus();
        
        console.log('Modo de edição ativado');
    }

    // Função para sair do modo de edição
    function exitEditMode() {
        isEditing = false;
        
        // Adicionar readonly aos campos
        formInputs.forEach(input => {
            input.setAttribute('readonly', true);
            input.classList.remove('editing');
        });
        
        // Alterar visibilidade dos botões
        editBtn.style.display = 'flex';
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
        
        console.log('Modo de edição desativado');
    }

    // Função para cancelar edição
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

    // Função para salvar alterações
    async function saveChanges() {
        if (!validateForm()) {
            return;
        }

        // Mostrar loading
        saveBtn.classList.add('loading');
        saveBtn.textContent = 'Salvando...';

      
    }

    // Event Listeners

    // Botão editar
    editBtn.addEventListener('click', enterEditMode);

    // Botão salvar
    saveBtn.addEventListener('click', saveChanges);

    // Botão cancelar
    cancelBtn.addEventListener('click', cancelEdit);

    // Formulário submit
    profileForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (isEditing) {
            saveChanges();
        }
    });

    // Formatação automática do CPF
    cpf.addEventListener('input', function() {
        if (!isEditing) return;
        
        let value = this.value.replace(/\D/g, '');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        this.value = value;
    });

  
    // Executar animação após um pequeno delay
    setTimeout(animatePageLoad, 200);

    // Inicialização
    loadUserData();
    
    console.log('Página de perfil REINTEGRA inicializada com sucesso!');
});