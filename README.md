# PESQUISA SOBRE CRIPTOGRAFIA EM PHP 

A criptografia em PHP é o uso de funções e ferramentas da linguagem para transformar dados legíveis em códigos secretos. Isso protege informações sensíveis, como senhas de usuários CPFs etc, garantindo que eles não possam ser lidos por pessoas não autorizadas.  

O seu uso possui muitas vantagens, como evitar que senhas sejam armazenadas em texto simples, aumentar a segurança da aplicação e facilitar a conformidade com leis de proteção de dados, como a Lei Geral de Proteção de Dados (LGPD). 

 

## Principais funções de criptografia do PHP: 

### password_hash() 

É a função recomendada para armazenar senhas de forma segura. Ela cria um hash (código) da senha utilizando algoritmos modernos, como o BCrypt ou Argon2. 

Exemplo: 

``` 
$senha = "123456"; 
$hash = password_hash($senha, PASSWORD_DEFAULT); 
 
echo $hash; 
```

### password_verify() 

Serve para verificar se a senha digitada corresponde ao hash armazenado no banco de dados. 

Exemplo: 

``` 
if (password_verify("123456", $hash)) { 
    echo "Senha correta"; 
} 
```

 

### openssl_encrypt() 

É utilizada para criptografar informações que posteriormente precisarão ser recuperadas, como documentos, tokens ou dados confidenciais. 

Exemplo: 

```
$texto = "Mensagem secreta"; 
 
$criptografado = openssl_encrypt( 
    $texto, 
    "AES-256-CBC", 
    "minhachave" 
); 
 
echo $criptografado; 
```

 

### openssl_decrypt() 

Realiza o processo inverso, recuperando o texto original. 

Exemplo:

``` 
$textoOriginal = openssl_decrypt( 
    $criptografado, 
    "AES-256-CBC", 
    "minhachave" 
); 
 
echo $textoOriginal; 
```

 

## Exemplo de quando usar cada um: 

Cadastro de usuário - password_hash(): 

O usuário cria uma conta: 

Nome: João 
Email: joao@email.com 
Senha: 123456 

Seria errado salvar a senha diretamente no banco, pois se alguém invadi-lo, terá acesso a todas as senhas. O correto é gerar um hash: 

``` 
$senha = "123456"; 
 
$hash = password_hash($senha, PASSWORD_DEFAULT); 
 
echo $hash; 
```

O banco salva: 

id | email              | senha 
1  | joao@email.com     | $2y$10$8Kz... 

A senha original nunca é armazenada. 

 

Usuário faz login - password_verify(): 

Depois, João tenta entrar: 

Email: joao@email.com 
Senha: 123456 

O PHP pega a senha digitada e compara com o hash salvo: 

``` 
$senhaDigitada = "123456"; 
 
if(password_verify($senhaDigitada, $hash)){ 
    echo "Login realizado!"; 
}else{ 
    echo "Senha incorreta!"; 
} 
```

Se a senha gerar o mesmo resultado, o acesso é liberado. 

 

Salvar CPF protegido - openssl_encrypt(): 

Em um sistema médico, por exemplo, onde é guardado informações do paciente: 

Nome: João 
CPF: 123.456.789-00 

O CPF precisa ser protegido, mas o sistema ainda precisa conseguir mostrar o CPF quando autorizado. Então, nesse caso se usa: 

``` 
$cpf = "123.456.789-00"; 
 
$cpfCriptografado = openssl_encrypt( 
    $cpf, 
    "AES-256-CBC", 
    "minha-chave-secreta" 
); 
 
echo $cpfCriptografado; 
```

O banco salva algo parecido: 

id | cpf 
1  | 8Hd72ks91jKx92Lm... 

Quem olhar o banco não consegue entender o CPF. 

 

Mostrar CPF para usuário autorizado - openssl_decrypt(): 

Quando um funcionário autorizado consulta o cadastro: 

```
$cpfOriginal = openssl_decrypt( 
    $cpfCriptografado, 
    "AES-256-CBC", 
    "minha-chave-secreta");
     
 
echo $cpfOriginal; 
```

Resultado: 

123.456.789-00 


## Fontes:

https://melhorweb.com.br/criptografia-em-php-nos-formatos-md5-crypt-e-base64/

https://www.devmedia.com.br/metodos-de-criptografia-php/17715

https://imasters.com.br/back-end/criptografia-segura-no-php



 