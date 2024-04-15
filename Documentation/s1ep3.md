php artisan make:model Post -m -c -f

php artisan make:model Category -m -f
php artisan make:migration create_category_post_table
php artisan migrate
php artisan db:seed
php artisan tinker
\App\Models\Post::count()
