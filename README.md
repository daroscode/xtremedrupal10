# xtremedrupal10
Para executar este projeto no Windows presume-se que:
- Você tem XAMPP com PHP na versão 8.1 ou maior
- Você tem a versão mais atual do Git e estará usando o "Git Bash" como terminal principal e sendo executado como Administrador.
- Você tem Composer instalado globalmente.
- Você tem Node e Gulp instalados globalmente.

## Instalação / Estrutura:
- Criar o arquivo settings local: ```cp web/sites/xtreme10.settings.local.php web/sites/default/settings.local.php```
- Criar o arquivo settings padrão: ```cp web/sites/xtreme10.settings.php web/sites/default/settings.php```
- Criar o arquivo services: ```cp web/sites/xtreme10.development.services.yml web/sites/default/services.yml```
- Instalar Drupal: ```composer install```
- Subir banco (comandos abaixo) 
- Importar configurações do Drupal (comandos abaixo)
- Limpar cache do Drupal (comandos abaixo)
- Acessar projeto Drupal (comandos abaixo)

## Comandos / Drush:
- Limpeza de cache: ```vendor/drush/drush/drush cr```
- Importar configurações: ```vendor/drush/drush/drush cim -y```
- Exportar configurações: ```vendor/drush/drush/drush cex -y```
- Logar no CMS: ```vendor/drush/drush/drush uli```

## Comandos / Banco de dados:
Quando for criado algo que seja gravado no banco de dados (ao invés de configurações)
- Criar dump do banco: ```vendor/drush/drush/drush sql-dump > db/database.sql```
- Subir banco de dados (Retirar do zip e rodar o comando): ```vendor/drush/drush/drush sql-cli < db/database.sql```
- Atualizar no repo: Zipar o arquivo .SQL criado.

## Comandos / Tema:

- Entre na pasta do tema: ```cd web/themes/custom/xtremedrupal10/```
- Instale as dependências: ```npm install```
- Para atualizar alterações feitas rode: ```gulp```

* Observação: Estas instruções são baseadas na versão 18.18.0 do Node
