// Aguarda o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function() {
    
    // Elementos do formulário
    const form = document.getElementById('loginForm');
    const email = document.getElementById('email');
    const senha = document.getElementById('senha');
    const submitBtn = document.querySelector('.submit-btn');
    const learnMoreBtn = document.querySelector('.learn-more-btn');
    const forgotLink = document.querySelector('.forgot-link');

    // Função para validar email
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Função para validar senha (mínimo 6 caracteres para login)
    function validateSenha(senha) {
        return senha.length >= 6;
    }

    // Função para mostrar erro no campo
    function showError(input, message) {
        const wrapper = input.parentElement;
        const inputGroup = wrapper.parentElement;
        const errorContainer = inputGroup.querySelector('.error-message');
        
        wrapper.classList.add('error');
        wrapper.classList.remove('success');
        
        if (errorContainer) {
            errorContainer.textContent = message;
            errorContainer.style.display = 'block';
        }
    }

    // Função para mostrar sucesso no campo
    function showSuccess(input) {
        const wrapper = input.parentElement;
        const inputGroup = wrapper.parentElement;
        const errorContainer = inputGroup.querySelector('.error-message');
        
        wrapper.classList.remove('error');
        wrapper.classList.add('success');
        
        if (errorContainer) {
            errorContainer.textContent = '';
            errorContainer.style.display = 'none';
        }
    }

    // Validação em tempo real para email
    email.addEventListener('blur', function() {
        const emailValue = this.value.trim();
        
        if (!emailValue) {
            showError(this, 'Email é obrigatório');
        } else if (!validateEmail(emailValue)) {
            showError(this, 'Digite um email válido');
        } else {
            showSuccess(this);
        }
    });

    // Validação em tempo real para senha
    senha.addEventListener('blur', function() {
        const senhaValue = this.value;
        
        if (!senhaValue) {
            showError(this, 'Senha é obrigatória');
        } else if (!validateSenha(senhaValue)) {
            showError(this, 'Senha deve ter pelo menos 6 caracteres');
        } else {
            showSuccess(this);
        }
    });

    // Função para validar todo o formulário
    function validateForm() {
        let isValid = true;
        
        // Validar email
        if (!email.value.trim()) {
            showError(email, 'Email é obrigatório');
            isValid = false;
        } else if (!validateEmail(email.value.trim())) {
            showError(email, 'Digite um email válido');
            isValid = false;
        }

        // Validar senha
        if (!senha.value) {
            showError(senha, 'Senha é obrigatória');
            isValid = false;
        } else if (!validateSenha(senha.value)) {
            showError(senha, 'Senha deve ter pelo menos 6 caracteres');
            isValid = false;
        }

        return isValid;
    }

    // Função para simular autenticação
    function authenticateUser(credentials) {
        // Simula uma requisição para o servidor
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                console.log('Tentativa de login:', credentials);
                
                // Simula validação de credenciais
                // Em um sistema real, isso seria feito no backend
                if (credentials.email === 'admin@reintegra.com' && credentials.senha === '123456') {
                    resolve({ 
                        success: true, 
                        message: 'Login realizado com sucesso!',
                        user: {
                            name: 'Administrador',
                            email: credentials.email
                        }
                    });
                } else {
                    reject({ 
                        success: false, 
                        message: 'Email ou senha incorretos' 
                    });
                }
            }, 1500);
        });
    }

    // Manipulador do envio do formulário
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!validateForm()) {
            return;
        }

        // Desabilitar botão e mostrar loading
        submitBtn.disabled = true;
        submitBtn.textContent = 'Entrando...';
        submitBtn.style.opacity = '0.7';

        try {
            const credentials = {
                email: email.value.trim(),
                senha: senha.value
            };

            const result = await authenticateUser(credentials);
            
            if (result.success) {
                // Mostrar mensagem de sucesso
                alert(`Bem-vindo de volta, ${result.user.name}!`);
                
                // Simular redirecionamento para dashboard
                console.log('Redirecionando para o dashboard...');
                
                // Em um sistema real, você redirecionaria para a página principal
                // window.location.href = '/dashboard';
                
                // Limpar formulário
                form.reset();
                
                // Remover classes de validação
                document.querySelectorAll('.input-wrapper').forEach(wrapper => {
                    wrapper.classList.remove('error', 'success');
                });
                
                // Limpar mensagens de erro
                document.querySelectorAll('.error-message').forEach(msg => {
                    msg.textContent = '';
                    msg.style.display = 'none';
                });
            }
        } catch (error) {
            // Mostrar erro de autenticação
            alert(error.message || 'Erro ao fazer login. Verifique suas credenciais.');
            console.error('Erro de autenticação:', error);
            
            // Destacar campos com erro
            showError(email, '');
            showError(senha, '');
        } finally {
            // Reabilitar botão
            submitBtn.disabled = false;
            submitBtn.textContent = 'Entrar';
            submitBtn.style.opacity = '1';
        }
    });

    // Funcionalidade do botão "Saiba mais"
    learnMoreBtn.addEventListener('click', function() {
        alert('Descubra oportunidades incríveis de emprego com o REINTEGRA!\n\nNossa plataforma conecta você às melhores vagas do mercado.');
    });

    // Funcionalidade do link "Esqueceu a senha?"
    forgotLink.addEventListener('click', function(e) {
        e.preventDefault();
        
        const userEmail = prompt('Digite seu email para recuperar a senha:');
        
        if (userEmail && validateEmail(userEmail)) {
            alert(`Um link de recuperação foi enviado para ${userEmail}`);
            console.log('Solicitação de recuperação de senha para:', userEmail);
        } else if (userEmail) {
            alert('Por favor, digite um email válido.');
        }
    });

    // Efeitos visuais adicionais
    
    // Animação de foco nos inputs
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });

    // Efeito de digitação no título
    function typeWriter(element, text, speed = 100) {
        let i = 0;
        element.textContent = '';
        
        function type() {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        
        type();
    }

    // Aplicar efeito de digitação no título da marca (opcional)
    const brandTitle = document.querySelector('.brand-title');
    if (brandTitle) {
        const originalText = brandTitle.textContent;
        setTimeout(() => {
            typeWriter(brandTitle, originalText, 150);
        }, 500);
    }

    // Adicionar efeito de parallax sutil no círculo decorativo
    const decorativeCircle = document.querySelector('.decorative-circle');
    if (decorativeCircle) {
        document.addEventListener('mousemove', function(e) {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            decorativeCircle.style.transform = `translate(${x * 20}px, ${y * 20}px)`;
        });
    }

    // Feedback visual para o botão de submit
    submitBtn.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px) scale(1.02)';
    });

    submitBtn.addEventListener('mouseleave', function() {
        if (!this.disabled) {
            this.style.transform = 'translateY(0) scale(1)';
        }
    });

    // Funcionalidade de "Enter" para submeter o formulário
    inputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                form.dispatchEvent(new Event('submit'));
            }
        });
    });

    // Mostrar credenciais de teste no console para facilitar testes
    console.log('=== CREDENCIAIS DE TESTE ===');
    console.log('Email: admin@reintegra.com');
    console.log('Senha: 123456');
    console.log('============================');

    console.log('Sistema de login REINTEGRA inicializado com sucesso!');
});

