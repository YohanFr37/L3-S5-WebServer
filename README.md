# - sQuizz

Ce repos est un projet éducatif dont le but est de créer un jeu de trivia pour navigateur en utilisant le framework symfony.

Le but de ce projet est de créer un site de quiz participatif. Les utilisateurs peuvent participer à des quizs, mais sont également en capacité de proposer de nouvelles questions, qui seront par la suite acceptées, modifiées ou rejetées par une équipe d’administration.

## Instalation

1 - Télécharger et installer un systeme de base de données tel que wamp/lamp/xamp...

2 - Telecharger et installer Symfony 5

3 - Cloner la branche master du projet dans le systeme de base de données

4 - Adapter les fichiers .env (root) et doctrine.yaml (config\package) a votre base de donnée/mot de passe/nom utilisateur (créer les fichiers si ils n'existent pas)

5 - Lancez le système de base de données

6 - Via terminal, dans le root du projet (dans le dossier nommé infoL3), executez la commande : "symfony serv"

7 - Toujours via terminal, créez la base de donnée en exécutant la commande suivante: “php bin/console doctrine:database:create”

8 - Connectez vous à votre base de donnée, puis importez le dump fournis dans le dossier dump a la racine du projet.

9 - Connectez vous à l'ip indiqué par le terminal à l'exécution de la commande permettant le lancement du serveur (soit un localhost:8000, soit 127.0.0.1:8000).
