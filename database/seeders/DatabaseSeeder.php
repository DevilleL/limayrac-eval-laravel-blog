<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * SEEDER FOURNI — NE PAS MODIFIER
 *
 * Insère 5 catégories et 10 tags de départ.
 *
 * Volontairement écrit avec DB::table()->insert() et NON avec Eloquent :
 * il doit pouvoir tourner même si les models (Category, Tag...) n'existent
 * pas encore. Aucun article n'est inséré : c'est à toi de tester ton CRUD.
 *
 * Le seeder est ré-exécutable sans dupliquer : il vide les tables avant
 * d'insérer (migrate:fresh --seed lancé 3 fois ne crée pas 15 catégories).
 *
 * Il est aussi tolérant : tant que tu n'as pas écrit les migrations
 * `categories` et `tags`, ces tables n'existent pas et le seeder les ignore
 * simplement, sans planter.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        if (Schema::hasTable('categories')) {
            DB::table('categories')->truncate();
            DB::table('categories')->insert([
                ['name' => 'Actualités',    'slug' => 'actualites'],
                ['name' => 'Tutoriels',     'slug' => 'tutoriels'],
                ['name' => 'Opinions',      'slug' => 'opinions'],
                ['name' => 'Interviews',    'slug' => 'interviews'],
                ['name' => 'Veille techno', 'slug' => 'veille-techno'],
            ]);
        } else {
            $this->command->warn("Table 'categories' absente : seeding ignoré (écris d'abord ta migration).");
        }

        if (Schema::hasTable('tags')) {
            DB::table('tags')->truncate();
            DB::table('tags')->insert([
                ['name' => 'PHP',         'slug' => 'php'],
                ['name' => 'Laravel',     'slug' => 'laravel'],
                ['name' => 'JavaScript',  'slug' => 'javascript'],
                ['name' => 'CSS',         'slug' => 'css'],
                ['name' => 'HTML',        'slug' => 'html'],
                ['name' => 'MySQL',       'slug' => 'mysql'],
                ['name' => 'DevOps',      'slug' => 'devops'],
                ['name' => 'Sécurité',    'slug' => 'securite'],
                ['name' => 'Performance', 'slug' => 'performance'],
                ['name' => 'UX',          'slug' => 'ux'],
            ]);
        } else {
            $this->command->warn("Table 'tags' absente : seeding ignoré (écris d'abord ta migration).");
        }

        Schema::enableForeignKeyConstraints();
    }
}
