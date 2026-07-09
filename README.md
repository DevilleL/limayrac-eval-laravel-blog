# Évaluation Laravel — Mini-blog

**Durée : 3h00**

## Contexte

Vous reprenez un projet Laravel déjà démarré. Un développeur a réalisé l'interface
(vues Blade, layout, formulaires) et les routes. Il est parti avant d'avoir écrit la
couche données.

**Votre mission : rendre l'application fonctionnelle.**

## Mise en route

```bash
git clone https://github.com/kevindupas/limayrac-eval-laravel-blog.git
cd limayrac-eval-laravel-blog
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

> ⚠️ Au démarrage, l'application affiche une erreur (`Class "App\Models\Article" not
> found`). **C'est normal.** Les migrations, models et controllers sont à écrire.

Vous pouvez écrire vos migrations et models à la main ou les **générer** avec Artisan :

```bash
php artisan make:model Article -m      # model + migration
php artisan make:model Category -m
php artisan make:model Tag -m
php artisan make:migration create_article_tag_table   # table pivot
```

## Règles

**Interdiction absolue de modifier :**

- le dossier `resources/views/`
- le fichier `routes/web.php`

Toute modification de ces fichiers entraîne l'annulation des points correspondants.
**Un `git diff` sera effectué à la correction.**

**Vous ne modifiez que :**

- `database/migrations/` (vos nouvelles migrations)
- `app/Models/`
- `app/Http/Controllers/`
- `app/Http/Requests/` (si vous choisissez d'en créer)

Chaque vue indique **en commentaire, en tête de fichier, le nom exact des variables
qu'elle attend**. Lisez-les.

## Schéma de données imposé

### Table `categories`

| Colonne | Type | Contraintes |
|---|---|---|
| id | bigint | PK, auto-increment |
| name | string | requis |
| slug | string | requis, unique |
| timestamps | | |

### Table `articles`

| Colonne | Type | Contraintes |
|---|---|---|
| id | bigint | PK, auto-increment |
| title | string | requis |
| slug | string | requis, unique |
| content | text | requis |
| status | enum | `draft`, `published` — défaut `draft` |
| published_at | datetime | nullable |
| category_id | bigint | FK vers `categories.id` |
| timestamps | | |

### Table `tags`

| Colonne | Type | Contraintes |
|---|---|---|
| id | bigint | PK, auto-increment |
| name | string | requis |
| slug | string | requis, unique |
| timestamps | | |

### Table `article_tag`

Table **pivot**. Deux clés étrangères. **Pas de timestamps.**

> ⚠️ L'ordre de création des migrations a une importance. Réfléchissez avant de
> lancer `php artisan migrate`.

## Travail demandé

### Partie 1 — Migrations et models (obligatoire)

- Créez les migrations correspondant au schéma ci-dessus.
- Créez les models `Article`, `Category`, `Tag`.
- Déclarez sur chacun la propriété `$fillable` adaptée.
- Déclarez les relations :
  - `Article` → sa `Category`
  - `Category` → ses `Article`
  - `Article` ↔ `Tag`

### Partie 2 — CRUD Article (obligatoire)

- Implémentez les 7 méthodes de `ArticleController`.
- Validation attendue sur `store` et `update` :

  | Champ | Règles |
  |---|---|
  | title | requis, chaîne, 255 caractères max |
  | slug | requis, unique dans `articles` |
  | content | requis |
  | status | requis, `draft` ou `published` |
  | category_id | requis, doit exister dans `categories` |

  > ⚠️ Sur `update`, un article ne doit pas être en conflit d'unicité avec lui-même.

- Après chaque `store`, `update` et `destroy`, redirigez avec un message flash `success`.

> 💡 La vue `articles/index` affiche la catégorie et les tags de chaque article.
> Chargez les relations correctement (évitez le N+1).

### Partie 3 — CRUD Category (obligatoire)

- Implémentez `index`, `create`, `store`, `destroy` de `CategoryController`.
- La vue `categories/index` affiche, pour chaque catégorie, le **nombre d'articles**
  qu'elle contient.

### Partie 4 — Tags et règle métier (bonus)

**4a.** Le formulaire d'article contient un champ `tags[]`. Faites en sorte que :
- à la création, les tags cochés soient associés à l'article ;
- à la modification, les tags de l'article correspondent **exactement** à ceux
  cochés (les anciens décochés doivent disparaître).

**4b.** Règle métier dans `CategoryController::destroy()` :
- On ne peut pas supprimer une catégorie qui contient **au moins un article publié**.
- La suppression est autorisée si la catégorie ne contient que des brouillons.
- En cas de refus : la catégorie reste en base, redirection avec message flash `error`.

**4c.** Déplacez la validation des articles dans une classe **FormRequest** dédiée.

## Barème — /20

| Critère d'évaluation | Points |
|---|---|
| Migrations (schéma exact, contraintes, FK, ordre) | 4 |
| Models (`$fillable`, 3 relations correctes) | 4 |
| CRUD Article (7 méthodes, validation, flash) | 6 |
| CRUD Category (4 méthodes, comptage des articles) | 3 |
| Bonus 4a — tags à la création et à la modification | 2 |
| Bonus 4b — règle métier sur la suppression | 0,5 |
| Bonus 4c — FormRequest | 0,5 |

> La qualité du code (lisibilité, absence de requêtes N+1, respect des conventions
> Laravel) peut faire varier la note de **±2 points**.

## En cas de blocage

| Message d'erreur | Ce que ça veut dire |
|---|---|
| `Class "App\Models\Article" not found` | Le model correspondant n'existe pas encore. |
| `Base table or view not found` | Une migration manque ou n'a pas été lancée. |
| `Undefined variable $listeArticles` | Le controller ne passe pas la variable attendue par la vue. |

> Ouvre la vue concernée et relis le bloc de commentaire en tête : il te donne le
> **nom exact** des variables attendues.
>
> Le seeder est ré-exécutable sans dupliquer : après avoir écrit tes migrations,
> `php artisan migrate:fresh --seed` recrée les tables et les repeuple (5 catégories,
> 10 tags). Aucun article n'est fourni : teste ton CRUD toi-même.

## Rendu

À la fin des 3h, sur une branche à votre nom :

```bash
git checkout -b rendu-<NOM>
git add .
git commit -m "Rendu <NOM> <Prénom>"
git push -u origin rendu-<NOM>
```

**Aucun push accepté après l'heure limite.**
