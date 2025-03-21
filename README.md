# Backend Challenge 20230105

## Resumo

Esse é o meu projeto de resolução do desafio TruckPag para a vaga de Desenvolvedor Laravel Pleno. 
Para resolver esse desafio, optei por instalar o Laravel 12 e usar o MariaDb como banco de dados. Mesmo sendo um projeto pequeno e simples, montei a api com uma arquitetura de Modulos orientados a serviços, o que facilitaria manutenção e inclusão de novas funcionalidades. 

Criei duas tabelas para gerenciar a api: 
imports_logs armazena qual url foi consultada e o status (sucesso ou falha).
foods armazena dados dos alimentos buscados na api.
### Instruções
 
No arquivo routes/console.php é aonde o cron que chama o comando que busca alimentos é gerado. Como padrão, esta selecionado para as 06:00. É feita uma busca na .env por um campo chamado SCHEDULED_COMMAND_TIME, no formato hh:mm. Caso encontre e o valor esta no formato esperado, o cron é atualizado para rodar no horário determinado. Para consultar digite: php artisan schedule:list


>  This is a challenge by [Coodesh](https://coodesh.com/)

