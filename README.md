# Controle de Funcionários - Avaliação PHP

Este projeto foi desenvolvido para avaliar conhecimentos em **PHP**, **MySQL** e **JavaScript**. A proposta é criar um sistema para controle de funcionários sem o uso de frameworks, garantindo que o código seja legível, comentado e manutenível.

> **Nota**: O projeto foi desenvolvido em **PHP 8.2**.

### 🗃️ Banco de Dados

O script SQL necessário para criar as tabelas do banco de dados está localizado no seguinte caminho:

- **Arquivo SQL**: [SQL/controle_funcionarios.sql](SQL/controle_funcionarios.sql)

### 🔧 Configuração do Banco de Dados

Para conectar o projeto ao banco de dados MySQL, siga os passos abaixo:

1. Acesse o arquivo de configuração do banco de dados:
   - **Arquivo de Conexão**: [db/conect.php](db/conect.php)

2. Edite os seguintes valores de acordo com sua configuração local ou remota:

```php
$dbName = "controle_funcionarios"; // Nome do banco de dados
$host = "localhost";               // Endereço do servidor (localhost, se estiver rodando localmente)
$user = "root";                    // Nome do usuário do banco de dados
$password = "senha";               // Senha do usuário do banco de dados
```

> **Nota**: Certifique-se de que o banco de dados esteja criado antes de executar o projeto. Você pode importar o arquivo `controle_funcionarios.sql` para gerar as tabelas e dados necessários.

### 🚀 Como Executar o Projeto

1. Faça o download ou clone o repositório:
   ```bash
   git clone https://github.com/MaquitoGW/projeto_avaliacao_php_new.git
   ```

2. Certifique-se de que o servidor PHP esteja rodando. Você pode usar ferramentas como **XAMPP**, **WAMP**, ou rodar diretamente via linha de comando:
   ```bash
   php -S localhost:8000
   ```

3. Acesse o sistema no navegador em: [http://localhost:8000](http://localhost:8000)