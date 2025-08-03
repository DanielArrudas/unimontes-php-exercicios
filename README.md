# ATIVIDADE 04 - ALGORITMOS EM PHP

Este repositório contém a resolução de uma lista de 12 exercícios de algoritmos utilizando PHP e HTML5. A atividade foi proposta como parte da disciplina de `Programação II` do curso de Sistemas de Informação da Universidade Estadual de Montes Claros - Unimontes.

O objetivo principal é aplicar e consolidar os conhecimentos na linguagem de programação PHP, abordando desde conceitos básicos e manipulação de formulários até o uso de classes (Programação Orientada a Objetos) e gerenciamento de sessões.

**Professor:** Eduardo Diniz Amaral

## 📝 Exercícios

A lista de exercícios abrange diferentes problemas para praticar a lógica de programação com PHP. Cada exercício está organizado em sua respectiva pasta.

**1. Verificador de Idade**
> Crie um formulário que solicite o nome e o ano de nascimento do usuário. Ao submeter, o PHP deve calcular a idade com base no ano atual e exibir uma mensagem como: **"João tem 22 anos e é maior de idade."** Considere 18 anos como limite de maioridade.

**2. Calculadora Aritmética Simples**
> Crie um formulário com dois números e uma operação (adição, subtração, multiplicação ou divisão usando `<select>`). Após o envio, o PHP deve realizar a operação escolhida e mostrar o resultado. Valide para evitar divisão por zero.

**3. Conversor de Moedas**
> Faça um formulário que permita inserir um valor em reais e escolher uma moeda para conversão (dólar, euro ou libra). No PHP, use taxas fixas definidas no código para fazer a conversão e mostre o valor convertido.

**4. Analisador de Notas**
> Solicite via formulário as três notas de um aluno. O PHP deve calcular a média e informar se o aluno está aprovado (média $\ge6$), em recuperação (entre 4 e 6) ou reprovado (média $<4)$.

**5. Contador de Caracteres e Palavras**
> Crie um formulário com um campo de texto (`<textarea>`). Ao enviar, o PHP deve contar e exibir: Quantidade de caracteres (com e sem espaços), Quantidade de palavras, Primeira e última palavra do texto.

**6. Calculadora de IMC (Índice de Massa Corporal)**
> Crie uma classe `Pessoa` com os atributos nome, peso e altura. Implemente um método que calcule o IMC e outro que retorne a classificação de acordo com o valor. Utilize um formulário HTML para o usuário informar seus dados. Ao submeter, o sistema deve retornar o nome, o IMC e a classificação.

**7. Sistema de Cadastro de Alunos (em Sessão)**
> Crie uma classe `Aluno` com os atributos nome, matricula e curso. Utilize um formulário HTML para cadastrar alunos e armazene-os em uma `$_SESSION`. Exiba todos os alunos cadastrados abaixo do formulário. Permita limpar todos os dados da sessão com um botão.

**8. Conversor de Temperatura com Classe**
> Implemente uma classe `Temperatura` com um atributo valor e métodos `converterParaFahrenheit()` e `converterParaCelsius()`. O formulário deve permitir inserir a temperatura e selecionar a conversão desejada. Exiba o resultado formatado após o envio.

**9. Controle de Estoque com Sessão**
> Crie uma classe `Produto` com os atributos nome, quantidade e preco. Crie um formulário que permita adicionar produtos (armazenando em `$_SESSION`) e outro para atualizar a quantidade. Liste todos os produtos abaixo, com opções de atualizar ou remover individualmente.

**10. Agenda de Compromissos (com Sessão)**
> Crie uma classe `Compromisso` com os atributos data, horario e descricao. Crie um formulário para registrar compromissos e armazene-os na `$_SESSION`. Exiba uma lista dos compromissos cadastrados, ordenados por data e horário (pode usar `usort()`).

**11. Simulador de Conta Bancária (em Sessão)**
> Implemente a classe `ContaBancaria` com os métodos `depositar()`, `sacar()` e `getSaldo()`. Use a `$_SESSION` para armazenar o saldo entre as requisições. Crie um formulário com opção de selecionar a operação (depósito ou saque) e o valor. Exiba o saldo atualizado.

**12. Gerador de Tabuada com Classe**
> Crie uma classe `Tabuada` com o atributo numero e um método `gerar()` que retorna um array com os valores de 1 a 10 multiplicados pelo número informado. Utilize o formulário HTML para o usuário informar o número e exiba a tabuada formatada em uma tabela HTML.

## 🛠️ Tecnologias Utilizadas

* **Backend:** PHP
* **Frontend:** HTML5

## 📂 Estrutura do Repositório

Os códigos-fonte de cada exercício estão separados em pastas individuais para melhor organização.

```
/
├── exercicio-01/
│   └── index.php
├── exercicio-02/
│   └── index.php
├── ...
└── README.md
```