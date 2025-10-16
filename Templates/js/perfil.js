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

    // Função para carregar dados do usuário (simulação)
    function loadUserData() {
        // Simular carregamento de dados do localStorage ou API
        const userData = getUserDataFromStorage() || getDefaultUserData();
        
        // Atualizar campos do formulário
        nomeCompleto.value = userData.nomeCompleto;
        email.value = userData.email;
        dataNascimento.value = userData.dataNascimento;
        cpf.value = userData.cpf;
        profissao.value = userData.profissao;
        
        // Atualizar elementos de exibição
        userName.textContent = userData.displayName;
        profileUserName.textContent = userData.displayName;
        profileUserEmail.textContent = userData.email;
        
        // Salvar dados originais
        originalData = { ...userData };
        
        console.log('Dados do usuário carregados:', userData);
    }

    // Função para obter dados do localStorage
    function getUserDataFromStorage() {
        try {
            const storedData = localStorage.getItem('reintegra_user_data');
            return storedData ? JSON.parse(storedData) : null;
        } catch (error) {
            console.error('Erro ao carregar dados do localStorage:', error);
            return null;
        }
    }

   
    // Função para salvar dados no localStorage
    function saveUserDataToStorage(userData) {
        try {
            localStorage.setItem('reintegra_user_data', JSON.stringify(userData));
            console.log('Dados salvos no localStorage:', userData);
        } catch (error) {
            console.error('Erro ao salvar dados no localStorage:', error);
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

        try {
            // Simular requisição para o servidor
            await new Promise(resolve => setTimeout(resolve, 2000));

            // Preparar dados atualizados
            const updatedData = {
                nomeCompleto: nomeCompleto.value.trim(),
                displayName: nomeCompleto.value.trim(),
                email: email.value.trim(),
                dataNascimento: dataNascimento.value,
                cpf: cpf.value.trim(),
                profissao: profissao.value.trim()
            };

            // Salvar no localStorage
            saveUserDataToStorage(updatedData);

        
            // Atualizar elementos de exibição
            userName.textContent = updatedData.displayName;
            profileUserName.textContent = updatedData.displayName;
            profileUserEmail.textContent = updatedData.email;

            // Sair do modo de edição
            exitEditMode();

            // Mostrar sucesso
            alert('Perfil atualizado com sucesso!');

            console.log('Dados salvos com sucesso:', updatedData);

        } catch (error) {
            console.error('Erro ao salvar dados:', error);
            alert('Erro ao salvar alterações. Tente novamente.');
        } finally {
            // Remover loading
            saveBtn.classList.remove('loading');
            saveBtn.innerHTML = '<span class="btn-icon"></span>Salvar Alterações';
        }
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

    // Botão voltar
    if (backBtn) {
        backBtn.addEventListener('click', function() {
            if (isEditing) {
                const confirmExit = confirm('Você tem alterações não salvas. Deseja sair mesmo assim?');
                if (!confirmExit) {
                    return;
                }
            }
            
            // Verificar se há histórico para voltar
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // Se não há histórico, redirecionar para página de serviços
                window.location.href = 'servicos.html';
            }
        });
    }

    // Cards de ação adicional
    actionCards.forEach(card => {
        card.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            handleAdditionalAction(action);
        });
    });

    // Função para lidar com ações adicionais
    function handleAdditionalAction(action) {
        switch (action) {
            case 'change-password':
                handleChangePassword();
                break;
            case 'privacy-settings':
                handlePrivacySettings();
                break;
            case 'logout':
                handleLogout();
                break;
            default:
                console.log('Ação não reconhecida:', action);
        }
    }

    // Função para alterar senha
    function handleChangePassword() {
        const currentPassword = prompt('Digite sua senha atual:');
        if (!currentPassword) return;

        const newPassword = prompt('Digite sua nova senha:');
        if (!newPassword) return;

        const confirmPassword = prompt('Confirme sua nova senha:');
        if (newPassword !== confirmPassword) {
            alert('As senhas não coincidem!');
            return;
        }

        if (newPassword.length < 6) {
            alert('A nova senha deve ter pelo menos 6 caracteres!');
            return;
        }

        // Simular alteração de senha
        alert('Senha alterada com sucesso!');
        console.log('Senha alterada para o usuário:', originalData.email);
    }

    // Função para configurações de privacidade
    function handlePrivacySettings() {
        alert('Configurações de Privacidade\n\n• Controle quem pode ver seu perfil\n• Gerencie suas preferências de notificação\n• Configure a visibilidade dos seus dados\n\n(Esta funcionalidade será implementada em breve)');
        console.log('Acessando configurações de privacidade');
    }

    // Função para logout
    function handleLogout() {
        const confirmLogout = confirm('Tem certeza que deseja sair da sua conta?');
        if (confirmLogout) {
            // Limpar dados de sessão (opcional)
            // localStorage.removeItem('reintegra_user_session');
            
            alert('Você foi desconectado com sucesso!');
            
            // Redirecionar para página de login
            window.location.href = 'login.html';
            
            console.log('Usuário desconectado');
        }
    }

    // Atualização em tempo real do nome no cabeçalho
    nomeCompleto.addEventListener('input', function() {
        if (!isEditing) return;
        
        const newName = this.value.trim();
        if (newName) {
            const displayName = newName;
            userName.textContent = displayName;
            profileUserName.textContent = displayName;
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

    // Efeitos visuais adicionais

    // Animação de entrada
    function animatePageLoad() {
        const elements = document.querySelectorAll('.profile-card, .action-card');
        elements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                element.style.transition = 'all 0.6s ease-out';
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    // Executar animação após um pequeno delay
    setTimeout(animatePageLoad, 200);

    // Inicialização
    loadUserData();
    
    console.log('Página de perfil REINTEGRA inicializada com sucesso!');
});