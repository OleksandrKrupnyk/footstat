


# Створення довідника

## Створення моделі

```bash
php artisan make:model Handbook/Owner -m
php artisan make:model Handbook/ScaleValue -m
php artisan make:model Handbook/Criterion -m
php artisan make:model Handbook/Club -m
php artisan make:model Handbook/ClubCriterion -m
php artisan make:model Stats/Mark -a
```

## Створення ресурсу

```bash
php artisan make:filament-resource Handbook/Country --generate
```
- `--generate`, `-G`
- `--soft-deletes`
- `--simple`, `-S`
- `--panel[=PANEL]`
- `-F`, `--force`

php artisan make:filament-resource Handbook/ScaleType --generate
php artisan make:filament-resource Handbook/Scale --generate

php artisan make:filament-resource Handbook/Country --generate

php artisan make:model Handbook/Scale -m
php artisan make:filament-resource Handbook/Scale --generate

php artisan make:filament-resource Handbook/ScaleValue --generate
php artisan make:filament-resource Handbook/Club --generate
php artisan make:filament-resource Handbook/ClubCriterion --generate
php artisan make:filament-resource Stats/Mark --generate
## Створення зв'язків між ресурсами

```bash
php artisan make:filament-relation-manager CategoryResource posts title
```
`CategoryResource` is the name of the resource class for the owner (parent) model.
`posts` is the name of the relationship you want to manage.
`title` is the name of the attribute that will be used to identify posts.

php artisan make:filament-relation-manager Handbook/ScaleResource values value

php artisan make:filament-resource Handbook/Criterion --generate


php artisan make:filament-relation-manager Handbook/ClubCriterion criteria  criterion_id


php artisan make:filament-widget BlogPostsChart --chart

```bash
php artisan db:seed
```
