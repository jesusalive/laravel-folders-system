## Sistema de arquivos - Laravel/vue

Feito como teste para processo seletivo na https://www.plenussistemas.com.br/

Para rodar o sistema siga esses passos:
 - ```composer install```
 - ```npm install``` ou ```yarn```
 - Crie o .env na raiz do projeto com o conteúdo do .env.example (No linux vc pode usar ```touch .env && cat .env.example >> .env``` e preencha os dados do seu banco sql
 - Depois rode ```php artisan migrate --seed```
 - Por último rode ```npm run dev ou yarn dev``` logo em seguida ```php artisan serve```
 
 Agora é só alegria :)
 
