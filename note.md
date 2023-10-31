## membuat respon formatter

php artisan make:resource ApiResource
php artisan make:resource PostResource

## membuat model
- untuk create model
php artisan make:model Category -m
setelah membuat model , lalu tambahkan column pada file migrate
php artisan make:model Destination -mcr


php artisan make:model Customer -mcr
php artisan make:model Review -mcr



php artisan make:model Region -m
setelah membuat model , lalu tambahkan column pada file migrate

php artisan make:model Role -m
setelah membuat model , lalu tambahkan column pada file migrate

php artisan make:model Profile -m
setelah membuat model , lalu tambahkan column pada file migrate


- untuk migrate
php artisan migrate


## membuat Controller 
1. Controller Category
php artisan make:controller Api/CategoryController
php artisan make:controller Api/LoginController
php artisan make:controller Api/RegionController
php artisan make:controller Api/RoleController
php artisan make:controller Api/ProfileController
php artisan make:controller Api/DestinationController
php artisan make:controller Api/RatingController
php artisan make:controller Api/DesKatController
php artisan make:controller Api/JamBukaController
php artisan make:controller Api/Controller


install gitbash sek 

cara clone 
1. pergi ke terminal / git bash 
link clone 
https://github.com/MuhammadWildanf/Tourist_Destinations.git

lek iki gae ndownload 
https://github.com/MuhammadWildanf/Tourist_Destinations


destinantion 
wilayahId
usahaId
categoryId


php artisan migrate:reset

php artisan migrate

php artisan db:seed


auth halaman 110

