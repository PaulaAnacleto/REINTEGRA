Feature: Navegação e visualização da página de catálogo de cursos

Scenario: Ao entrar na página, visualizo os links de Navegação
Dado que eu acesso a página de cursos
Quando a página é carregada
Então devo visualizar a barra de navegação com a logo
E os links para outras páginas


Scenario: Acessar página de Serviços
Dado que eu acesso a página de cursos
Quando a página é carregada
E clico no botão "Serviços"
Então eu devo ser redirecionado a página de Serviços


Scenario: Acessar a sessão "Feedback" da página inicial
Dado que eu acesso a página de cursos
Quando a página é carregada
E clico no botão "Feedback"
Então eu devo ser redirecionado a sessão "Feedback" na página inicial


Scenario: Acessar página de Contato
Dado que eu acesso a página de cursos
Quando a página é carregada
E clico no botão "Contato"
Então eu devo ser redirecionado a página de Contato


Scenario: Acessar a sessão "Sobre" da página inicial
Dado que eu acesso a página de cursos
Quando a página é carregada
E clico no botão "Sobre"
Então eu devo ser redirecionado a sessão "Sobre" na página inicial

Scenario: Acessar página inicial
Dado que eu acesso a página de cursos
Quando a página é carregada
E clico no botão "Início"
Então eu devo ser redirecionado a página inicial


Scenario: Acessar página de perfil
Dado que eu acesso a página de cursos
Quando a página é carregada
E clico no botão com ícone de Perfil
Então eu devo ser redirecionado a página de Perfil


Scenario: Voltar para a página anterior
Dado que eu acesso a página de cursos
Quando a página é carregada
E clico no botão com ícone de seta
Então eu devo ser redirecionado a página anterior que eu estava navegando


Scenario: Acessar página do curso
Dado que eu acesso a página de cursos
Quando a página é carregada
E clico no título do card
Então eu devo ser redirecionado ao site do curso daquele card


Scenario: Acessar página Políticas de Privacidade
Dado que eu acesso a página de cursos
Quando a página é carregada
E clico no botão "Políticas de Privacidade" do footer
Então eu devo ser redirecionado a página Políticas de Privacidade


Scenario: Acessar página Termos de Serviço
Dado que eu acesso a página de cursos
Quando a página é carregada
E clico no botão "Termos de Serviço" do footer
Então eu devo ser redirecionado a página Termos de Serviço

s
Scenario: Verificar se o widget VLibras é carregado corretamente
Dado que eu acesso a página inicial
Quando a página é carregada
Então o widget VLibras deve estar visível na tela