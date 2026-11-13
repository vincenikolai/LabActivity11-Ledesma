# Barangay Bulletin - Purok Ledesma

This is my Laravel Barangay Bulletin application. It includes posts, authors,
comments, tags, and a simple login page.

## Personalization

- Pagination is set to 7 items per page because my last name, Ledesma, has 7
  letters.
- My custom category is **Sports**.
- My manually seeded pinned post is dated **September 14, 2004**, my birthday.

## Seeded Login Accounts

The seeder creates these two accounts with the same password:

| Name | Email | Role or account use | Password |
| --- | --- | --- | --- |
| Lola Ledesma | `lola.ledesma@bulletin.test` | Regular user and commenter | `bulletin2026` |
| Kagawad Ledesma | `kagawad.ledesma@bulletin.test` | User account linked to the Kagawad author profile | `bulletin2026` |

The application does not store a separate user `role` field. The Kagawad
position comes from the related author record. The seeder also creates eight
additional users with generated names and credentials.

## Custom Tags

The tag seeder creates these five tags:

- `Purok Ledesma`
- `Urgent`
- `Libre`
- `Schedule`
- `Ayuda`

Pinned posts are assigned exactly `Purok Ledesma` and `Urgent`. Each standard
(non-pinned) post receives between one and three randomly selected tags from
the five tags above.

## Model Relationships

The Eloquent models are connected as follows:

- **User**
  - Has one `Author` profile.
  - Has many `Comment` records.
- **Author**
  - Belongs to one `User`.
  - Has many `Post` records.
  - Has many `Comment` records through its posts.
- **Post**
  - Belongs to one `Author`.
  - Has many `Comment` records.
  - Belongs to many `Tag` records.
- **Comment**
  - Belongs to one `Post`.
  - Belongs to one `User`.
- **Tag**
  - Belongs to many `Post` records.

## How to Run Locally

Make sure PHP 8.3+, Composer, Node.js, and npm are installed.

From the project directory, install the dependencies and create the local
environment file:

```powershell
composer install
cp .env.example .env
php artisan key:generate
npm install
```

On Windows PowerShell, use `Copy-Item .env.example .env` if `cp` is not
available.

This project uses SQLite. The `.env.example` file already sets
`DB_CONNECTION=sqlite`, and the database file is `database/database.sqlite`.
Run the migrations and seed the sample data:

```powershell
php artisan migrate:fresh --seed
```

Start the Laravel server in one terminal:

```powershell
php artisan serve
```

Start the Vite development server in a second terminal:

```powershell
npm run dev
```

The application is available at <http://localhost:8000>.
