# php-api-sem-framework

Nessa aplicação foi criada uma api em php sem nenhum framework externo.

![site illustrato](https://tinypic.host/images/2023/11/28/Capture.png)

## Funcionalidade 


#### Usuarios:

- Autenticação: Possue uma segurança via autenticação por meio de login, o usuario deve estar logado no sistema para poder estar realizando a listagem de elementos na api assim como qualquer alteração de dados.

- JWT Autenticação por token: Por segurança o usuario cadastrado terá acesso limitado aos dados da api, quando o usuario e logado e gerado um token especifico para esse usuario, para visualizar os dados da api ou fazer qualquer alteração ele deve fornecer o token de segurança que foi lhe entregue no header da requisição, só assim ele será logado no sistema.

- Vencimento do token: Por segurança o token ficará ativo por 1 hora ápos isso o usuário será excluido do banco de dados assim bloqueando o acesso do usuário a api, ele deverá então relogar no sistema se quiser ter novamento acesso a api.

#### Acesso a usuários logados:

- GET: Possue a listagem de todos os usuários cadastrados no sistema

- GET/{id}: Possibilitada a visualização de apenas 1 usuario na qual tenha o id sendo enviado na requisição assim listando apenas o usuário com aquele id que está cadastrado no banco de dados.

- POST: Possibilita o cadastro de usuário ao banco de dados com as informação padrão já cadastradas que são: nome,email,cidade,estado e telefone , mas também permite a adição de colunas novas a tabela.

- PUT/{id}: Possibilita com que o usuário com o id fornecido na requisição tenha seus dados editados.

- DELETE/{id}: Possibilita com que o usuário com o id fornecido na requisição tenha todos os seus dados excluidos.


Tecnologias:

PHP
