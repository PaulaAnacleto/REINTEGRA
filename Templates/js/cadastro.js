document.addEventListener('DOMContentLoaded', function() {
  
  const form = document.getElementById('cadastroForm');
  const nomeCompleto = document.getElementById('nomeCompleto');
  const email = document.getElementById('email');
  const senha = document.getElementById('senha');
  const confirmarSenha = document.getElementById('confirmarSenha');
  const submitBtn = document.querySelector('.submit-btn');
  const learnMoreBtn = document.querySelector('.learn-more-btn');

  function createErrorMessage(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    return errorDiv;
  }

  function validateNome(nome) {
    const nomeRegex = /^[a-zA-ZÀ-ÿ\s]{2,50}$/;
    return nomeRegex.test(nome.trim()) && nome.trim().split(' ').length >= 2;
  }

  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  function validateSenha(senha) {
    const senhaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,}$/;
    return senhaRegex.test(senha);
  }

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


  function validateForm() {
    let isValid = true;
    
    if (!nomeCompleto.value.trim()) {
      showError(nomeCompleto, 'Nome completo é obrigatório');
      isValid = false;
    } else if (!validateNome(nomeCompleto.value.trim())) {
      showError(nomeCompleto, 'Digite seu nome completo (nome e sobrenome)');
      isValid = false;
    } else {
            showSuccess(nomeCompleto);
        }

    if (!email.value.trim()) {
      showError(email, 'Email é obrigatório');
      isValid = false;
    } else if (!validateEmail(email.value.trim())) {
      showError(email, 'Digite um email válido');
      isValid = false;
    } else {
            showSuccess(email); 
        }

    if (!senha.value) {
      showError(senha, 'Senha é obrigatória');
      isValid = false;
    } else if (!validateSenha(senha.value)) {
      showError(senha, 'Senha deve ter pelo menos 8 caracteres, incluindo maiúscula, minúscula e número');
      isValid = false;
    } else {
            showSuccess(senha); 
        }

    if (!confirmarSenha.value) {
      showError(confirmarSenha, 'Confirmação de senha é obrigatória');
      isValid = false;
    } else if (confirmarSenha.value !== senha.value) {
      showError(confirmarSenha, 'As senhas não coincidem');
      isValid = false;
    } else {
            showSuccess(confirmarSenha); 
        }

    return isValid;
  }

form.addEventListener('submit', async function(e) {
  e.preventDefault();

  if (!validateForm()) {
    console.log('Formulário inválido');
    return;
  }

  submitBtn.disabled = true;
  submitBtn.textContent = 'Cadastrando...';
  submitBtn.style.transform = 'translateY(0) scale(1)';

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

  const inputs = document.querySelectorAll('input');
  inputs.forEach(input => {
    input.addEventListener('focus', function() {
      this.parentElement.style.transform = 'scale(1.02)';
    });
    
    input.addEventListener('blur', function() {
      this.parentElement.style.transform = 'scale(1)';
    });
  });

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

  const brandTitle = document.querySelector('.brand-title');
  if (brandTitle) {
    const originalText = brandTitle.textContent;
    setTimeout(() => {
      typeWriter(brandTitle, originalText, 150);
    }, 500);
  }

  const decorativeCircle = document.querySelector('.decorative-circle');
  if (decorativeCircle) {
    document.addEventListener('mousemove', function(e) {
      const x = e.clientX / window.innerWidth;
      const y = e.clientY / window.innerHeight;
      
      decorativeCircle.style.transform = `translate(${x * 20}px, ${y * 20}px)`;
    });
  }

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