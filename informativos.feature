Feature: Navegação e visualização da página de informativos

Scenario: Ao entrar na página, visualizo os links de Navegação
Dado que eu acesso a página de informativos
Quando a página é carregada
Então devo visualizar a barra de navegação com a logo
E os links para outras páginas


Scenario: Acessar página de Serviços
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Serviços"
Então eu devo ser redirecionado a página de Serviços


Scenario: Acessar a sessão "Feedback" da página inicial
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Feedback"
Então eu devo ser redirecionado a sessão "Feedback" na página inicial


Scenario: Acessar página de Contato
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Contato"
Então eu devo ser redirecionado a página de Contato


Scenario: Acessar a sessão "Sobre" da página inicial
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Sobre"
Então eu devo ser redirecionado a sessão "Sobre" na página inicial

Scenario: Acessar página inicial
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Início"
Então eu devo ser redirecionado a página inicial


Scenario: Acessar página de perfil
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão com ícone de Perfil
Então eu devo ser redirecionado a página de Perfil


Scenario: Voltar para a página anterior
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão com ícone de seta
Então eu devo ser redirecionado a página anterior que eu estava navegando


Scenario: Acessar página "Exame – seção Mercado de Trabalho"
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Saiba mais" do card "Exame – seção Mercado de Trabalho"
Então eu devo ser redirecionado ao site "Exame – seção Mercado de Trabalho"


Scenario: Acessar página "Forbes Brasil"
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Saiba mais" do card "Forbes Brasil"
Então eu devo ser redirecionado ao site "Forbes Brasil"


Scenario: Acessar página "InfoMoney - seção Mercado de Trabalho"
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Saiba mais" do card "InfoMoney - seção Mercado de Trabalho"
Então eu devo ser redirecionado ao site "InfoMoney - seção Mercado de Trabalho"


Scenario: Acessar página "Vagas do Dia - SineBahia"
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Saiba mais" do card "Vagas do Dia - SineBahia"
Então eu devo ser redirecionado ao site "Vagas do Dia - SineBahia"


Scenario: Acessar página "Agência Brasil / EBC"
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Saiba mais" do card "Agência Brasil / EBC"
Então eu devo ser redirecionado ao site "Agência Brasil / EBC"


Scenario: Acessar página Políticas de Privacidade
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Políticas de Privacidade" do footer
Então eu devo ser redirecionado a página Políticas de Privacidade


Scenario: Acessar página Termos de Serviço
Dado que eu acesso a página de informativos
Quando a página é carregada
E clico no botão "Termos de Serviço" do footer
Então eu devo ser redirecionado a página Termos de Serviço


Scenario: Verificar se o widget VLibras é carregado corretamente
Dado que eu acesso a página inicial
Quando a página é carregada
Então o widget VLibras deve estar visível na tela
E o botão de acesso do VLibras deve estar ativo e visível