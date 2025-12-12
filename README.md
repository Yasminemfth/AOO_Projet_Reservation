# AOO_Projet_Reservation — NatureQuest

Projet réalisé par :
- Clara Marchal  
- Yasmine Metfah  
- Lorenzo L'Hostis  

NatureQuest est un **système complet de réservation pour un parc d’activités**, développé en **PHP orienté objet** selon une **architecture MVC (Model / View / Controller)**.

---

## Fonctionnalités

- Création de compte & connexion
- Consultation des activités
- Réservation d’activités
- Annulation & gestion des réservations
- Espace administrateur :
  - ajout / modification / suppression d’activités

---

## 🛠️ Ce que nous avons réalisé

- Mise en place de la base de données *(users, activities, reservations…)*
- Implémentation des modèles MVC *(User, Activite, Reservation)*
- Système de rôles *(user / admin)* + sécurisation des accès
- Gestion des erreurs, typage strict, protections SQL *(requêtes préparées)*

---

##  Stack

- PHP
- HTML
- CSS

---

## 🚀 Lancer le projet (local)

### 1) Démarrer le serveur PHP
Depuis la racine du projet :
```bash
php -S 127.0.0.1:8000
http://127.0.0.1:8000/user/login
