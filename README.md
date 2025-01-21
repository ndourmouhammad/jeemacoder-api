# API pour la Gestion des Installations sportives

Ce projet est une API Laravel conçue dans le cadre du hackathon Jeemacoder. Elle permet de gérer les réservations pour des installations  sportives avec des fonctionnalités telles que l'authentification, la gestion des disponibilités, et le suivi des réservations.

## 🚀 Fonctionnalités

- **Authentification** :
  - Inscription (`/register`)
  - Connexion (`/login`)
  - Déconnexion (`/logout`)

- **Gestion des Installations** :
  - Récupérer les installations disponibles (`GET /installations/disponibles`)
  - Mettre à jour une installation (`PUT /installations/{id}`)
  - Définir une installation comme disponible (`PUT /installations/{id}/disponible`)
  - Définir une installation comme indisponible (`PUT /installations/{id}/indisponible`)
  - Récupérer l'ensemble des installations (`GET /installations`)
  - Modifier une installation (`POST /installations/{id}`)
  - Supprimer une installation (`DELETE /installations/{id}`)

- **Gestion des Réservations** :
  - Créer une réservation (`POST /installations/{installation_id}/reservations`)
  - Confirmer une réservation (`PUT /reservations/{id}/confirm`)
  - Annuler une réservation (`PUT /reservations/{id}/cancel`)
  - Voir mes réservations (`GET /mes/reservations`)
  - Voir toutes les réservations (`GET /reservations`)

## 🛠️ Prérequis

- PHP >= 8.3.15
- Composer 2.7.8
- MySQL
- Laravel >= 11

## 📦 Installation

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/votre-utilisateur/votre-repo.git
   cd votre-repo
   ```

2. Installez les dépendances backend :
   ```bash
   composer install
   ```

3. Configurez le fichier `.env` :
   - Dupliquez le fichier `.env.example` et renommez-le en `.env`.
   - Configurez les variables de connexion à la base de données.
   - Configurer la partie email

4. Générez la clé de l'application :
   ```bash
   php artisan key:generate
   ```

5. Exécutez les migrations et les seeders :
   ```bash
   php artisan migrate --seed
   ```

6. Lancez le serveur local :
   ```bash
   php artisan serve
   ```

## 🔑 Authentification

### Inscription
**Endpoint** : `POST /register`  
**Paramètres** :
- `name` : Nom de l'utilisateur
- `email` : Email de l'utilisateur
- `password` : Mot de passe
- `password_confirmation` : Confirmation du mot de passe

### Connexion
**Endpoint** : `POST /login`  
**Paramètres** :
- `email` : Email de l'utilisateur
- `password` : Mot de passe

### Déconnexion
**Endpoint** : `POST /logout`  
**Headers** :
- `Authorization` : `Bearer {token}`

## 📖 Documentation des Endpoints

Vous pouvez consulter la documentation complète des endpoints via swagger. Pour générer la documentation Swagger :
```bash
php artisan l5-swagger:generate
```
Accédez à la documentation à l'adresse suivante : `http://localhost:8000/api/documentation`.

## 📂 Structure des Routes

Les routes principales sont définies dans le fichier `routes/api.php`. Voici un aperçu des routes :

```php
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout']);

Route::get('/installations/disponibles', [InstallationController::class, 'getAvailableInstallations']);
Route::middleware('auth')->group(function () {
    Route::post('/installations/{installation_id}/reservations', [ReservationController::class, 'store']);
    Route::put('/reservations/{id}/confirm', [ReservationController::class, 'confirm']);
    Route::put('/reservations/{id}/cancel', [ReservationController::class, 'cancel']);
    Route::get('/mes/reservations', [ReservationController::class, 'myReservations']);
    Route::get('/reservations', [ReservationController::class, 'reservations']);
});
```

## 🧑‍💻 Collaboration

Les développeurs front peuvent utiliser les endpoints ci-dessus pour intégrer l'API. Pour toute question, n'hésitez pas à me contacter.

## 📝 Contribuer

1. Forkez le projet.
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/nom-feature`).
3. Commitez vos modifications (`git commit -m 'Ajout d'une nouvelle fonctionnalité'`).
4. Poussez vos modifications (`git push origin feature/nom-feature`).
5. Ouvrez une Pull Request.

## 📜 Licence

Ce projet est sous licence MIT. Consultez le fichier `LICENSE` pour plus de détails.

---

🚀 **Bon hackathon à tous !**
