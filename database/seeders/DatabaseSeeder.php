<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Handbook\Club;
use App\Models\Handbook\Country;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['countries'];
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Model::unguard();
        Schema::disableForeignKeyConstraints();
        foreach($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();

        $this->command->warn(PHP_EOL . 'Creating countries...');
        $countries =
            $this->withProgressBar(10, fn ()=>Country::factory()
                ->count(10)
                ->create());
        $this->command->info('Countries created.');

        $this->command->warn(PHP_EOL . 'Creating clubs...');
        $clubs = $this->withProgressBar(10, fn()=>Club::factory()->count(10)
            ->create());
        $this->command->info('Clubs created.');

        Model::reguard();
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);

        $progressBar->start();

        $items = new Collection();

        foreach (range(1, $amount) as $i) {
            $items = $items->merge(
                $createCollectionOfOne()
            );
            $progressBar->advance();
        }

        $progressBar->finish();

        $this->command->getOutput()->writeln('');

        return $items;
    }
}
