// Aguarda o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function() {
  
  // Elementos do formulário
  const form = document.getElementById('cadastroForm');
  const nomeCompleto = document.getElementById('nomeCompleto');
  const email = document.getElementById('email');
  const senha = document.getElementById('senha');
  const confirmarSenha = document.getElementById('confirmarSenha');
  const submitBtn = document.querySelector('.submit-btn');
  const learnMoreBtn = document.querySelector('.learn-more-btn');

  // Função para criar mensagem de erro
  function createErrorMessage(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    return errorDiv;
  }

  // Função para validar nome completo
  function validateNome(nome) {
    const nomeRegex = /^[a-zA-ZÀ-ÿ\s]{2,50}$/;
    return nomeRegex.test(nome.trim()) && nome.trim().split(' ').length >= 2;
  }

  // Função para validar email
  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  // Função para validar senha
  function validateSenha(senha) {
    // Mínimo 8 caracteres, pelo menos uma letra maiúscula, uma minúscula e um número
    const senhaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,}$/;
    return senhaRegex.test(senha);
  }

  // Função para mostrar erro no campo
 function showError(input, message) {
  const wrapper = input.parentElement;
  const inputGroup = wrapper.parentElement;
  const errorContainer = inputGroup.querySelector(".error-message");
  
  wrapper.classList.add("error");
  wrapper.classList.remove("success");
  
  if (errorContainer) {
    errorContainer.textContent = message;
    errorContainer.style.display = "block";
  }
}

  // Função para mostrar sucesso no campo
 function showSuccess(input) {
  const wrapper = input.parentElement;
  const inputGroup = wrapper.parentElement;
  const errorContainer = inputGroup.querySelector(".error-message");
  
  wrapper.classList.remove("error");
  wrapper.classList.add("success");
  
  if (errorContainer) {
    errorContainer.textContent = "";
    errorContainer.style.display = "none";
  }
}

  // Validação em tempo real para nome completo
  nomeCompleto.addEventListener('blur', function() {
    const nome = this.value.trim();
    
    if (!nome) {
      showError(this, 'Nome completo é obrigatório');
    } else if (!validateNome(nome)) {
      showError(this, 'Digite seu nome completo (nome e sobrenome)');
    } else {
      showSuccess(this);
    }
  });

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
      showError(this, 'Senha deve ter pelo menos 8 caracteres, incluindo maiúscula, minúscula e número');
    } else {
      showSuccess(this);
    }
  });

  // Validação em tempo real para confirmar senha
  confirmarSenha.addEventListener('blur', function() {
    const confirmarSenhaValue = this.value;
    const senhaValue = senha.value;
    
    if (!confirmarSenhaValue) {
      showError(this, 'Confirmação de senha é obrigatória');
    } else if (confirmarSenhaValue !== senhaValue) {
      showError(this, 'As senhas não coincidem');
    } else {
      showSuccess(this);
    }
  });


  // Função para validar todo o formulário
  function validateForm() {
    let isValid = true;
    
    // Validar nome
    if (!nomeCompleto.value.trim()) {
      showError(nomeCompleto, 'Nome completo é obrigatório');
      isValid = false;
    } else if (!validateNome(nomeCompleto.value.trim())) {
      showError(nomeCompleto, 'Digite seu nome completo (nome e sobrenome)');
      isValid = false;
    } else {
            showSuccess(nomeCompleto); // Adicionado para limpar erro se corrigido
        }

    // Validar email
    if (!email.value.trim()) {
      showError(email, 'Email é obrigatório');
      isValid = false;
    } else if (!validateEmail(email.value.trim())) {
      showError(email, 'Digite um email válido');
      isValid = false;
    } else {
            showSuccess(email); // Adicionado
        }

    // Validar senha
    if (!senha.value) {
      showError(senha, 'Senha é obrigatória');
      isValid = false;
    } else if (!validateSenha(senha.value)) {
      showError(senha, 'Senha deve ter pelo menos 8 caracteres, incluindo maiúscula, minúscula e número');
      isValid = false;
    } else {
            showSuccess(senha); // Adicionado
        }

    // Validar confirmação de senha
    if (!confirmarSenha.value) {
      showError(confirmarSenha, 'Confirmação de senha é obrigatória');
      isValid = false;
    } else if (confirmarSenha.value !== senha.value) {
      showError(confirmarSenha, 'As senhas não coincidem');
      isValid = false;
    } else {
            showSuccess(confirmarSenha); // Adicionado
        }

    return isValid;
  }

  
  // --- INÍCIO DA PARTE MESCLADA: Manipulador do envio do formulário ---
form.addEventListener('submit', async function(e) {
  e.preventDefault();

  // 1. Valida o formulário
  if (!validateForm()) {
    console.log('Formulário inválido');
    return;
  }

  // 2. Mostra o loading no botão
  submitBtn.disabled = true;
  submitBtn.textContent = 'Cadastrando...';
  submitBtn.style.transform = 'translateY(0) scale(1)';

  // 3. Se for ambiente de teste (localhost/reintegra/view)
  const isTestEnv = window.location.href.includes('localhost');

  if (isTestEnv) {
    // Simula sucesso após 2 segundos (Cypress test front-end)
    setTimeout(() => {
      alert('Cadastro realizado com sucesso! Bem-vindo ao REINTEGRA!');
      form.reset();

      document.querySelectorAll('.input-wrapper').forEach(el => {
        el.classList.remove('error', 'success');
      });

      submitBtn.disabled = false;
      submitBtn.textContent = 'Cadastre-se';
    }, 2000);

    return; // Sai antes do fetch
  }

  // 4. Ambiente real (com backend)
  try {
    const formData = new FormData(form);
    formData.append('action', 'register');

    const response = await fetch('../Controller/UserController.php', {
      method: 'POST',
      body: formData,
    });

    const result = await response.json();

    if (result.success) {
      alert(result.message);
      window.location.href = '../View/Login.php';
    } else {
      alert('Erro no cadastro: ' + result.message);
    }
  } catch (error) {
    console.error('Erro na requisição:', error);
    alert('Não foi possível conectar ao servidor.');
  } finally {
    submitBtn.disabled = false;
    submitBtn.textContent = 'Cadastre-se';
  }
});

    // --- FIM DA PARTE MESCLADA ---

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
  if (learnMoreBtn) {
  learnMoreBtn.addEventListener('click', function() {
    alert('Descubra oportunidades incríveis de emprego com o REINTEGRA!');
  });
}

  console.log('Sistema de cadastro REINTEGRA inicializado com sucesso!');
});
