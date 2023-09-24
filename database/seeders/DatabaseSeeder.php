<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Handbook\Club;
use App\Models\Handbook\ClubCriterion;
use App\Models\Handbook\Country;
use App\Models\Handbook\Criterion;
use App\Models\Handbook\Scale;
use App\Models\Stats\Mark;
use Closure;
use Database\Factories\Handbook\CriterionFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['countries', 'scales', 'criteria', 'club_criteria', 'marks', 'clubs'];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Model::unguard();
        Schema::disableForeignKeyConstraints();
        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();

        $this->command->warn(PHP_EOL . 'Creating countries...');
        $countries =
            $this->withProgressBar(10, fn() => Country::factory()
                ->count(1)
                ->create());
        $this->command->info('Countries created.');

        $this->command->warn(PHP_EOL . 'Creating clubs...');
        $clubs = $this->withProgressBar(80, fn() => Club::factory()->count(1)
            ->state(fn(array $attributes) => ['country_code' => $countries->random(1)->first()->code])
            ->create());
        $this->command->info('Clubs created.');

        $this->command->warn(PHP_EOL . 'Creating Scales');
        $scales = $this->withProgressBar(3, fn() => Scale::factory()->count(1)
            ->create());
        $this->command->info('Scales created.');

        $this->command->warn(PHP_EOL . 'Creating Criteria');
        $collection = collect(CriterionFactory::Title);
        $criteria = $this->withProgressBar(3,
            fn() => Criterion::factory()->count(1)
                ->state(
                    fn(array $attributes) => [
                        'scale_id' => $scales->random(1)->first()->id,
                        'title' => $collection->shift(1)
                    ]
                )
                ->create()
        );
        $this->command->info('Criteria created.');

        $cr = [];
        foreach ($clubs as $c) {
            foreach ($criteria as $a) {
                $cr[] = [$c->id, $a->id];
            }
        }
        $crc = collect($cr);
        $criteria = $criteria->keyBy('id');
        $scales = $scales->keyBy('id');
        $this->command->warn(PHP_EOL . 'Creating Criteria Clubs');
        $clubCriterion = $this->withProgressBar(count($cr), fn() => ClubCriterion::factory()->count(1)
            ->state(
                function (array $attributes) use ($crc) {
                    $el = $crc->shift();
                    return [
                        'club_id' => $el[0],
                        'criterion_id' => $el[1],
                    ];
                }
            )
            ->create());
        $this->command->info('Criteria clubs created.');

        $this->command->warn(PHP_EOL . 'Creating MarkRecords');
        $this->withProgressBar(1, fn() => Mark::factory()->count(
            fake()->numberBetween(100, $clubs->count() * 100))
            ->state(function (array $attributes) use ($clubCriterion, $criteria, $scales) {
                $record = $clubCriterion->random(1)->first();
                $scale_id = $criteria->get($record->criterion_id)->scale_id;
                $scale = $scales->get($scale_id);
                return [
                    'club_id' => $record->club_id,
                    'club_criteria_id' => $record->id,
                    'user_id' => fake()->numberBetween(1,3),
                    'scale_type' => 'NUMBER',
                    'mark_value' => fake()->numberBetween(0, $scale->max_value - $scale->offset)
                ];
            })
            ->create());


        $this->command->info('MarkRecords created.');


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
