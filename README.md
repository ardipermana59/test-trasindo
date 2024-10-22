# Tes Pemograman PT. Transindo Data Perkasa 

File Soal <a href='soal.pdf'>Soal.pdf </a>

## Setup Lingkungan Pengembangan

Pastikan Anda menggunakan bundle pack Laragon versi Full 6.0 dengan persyaratan berikut:****

- **Maria DB** versi 10.5
- **PHP** versi 8.2.16
- **Node.js** versi 18.8.0
- **NPM** versi 8.18.0

## Instruksi Instalasi

Instalasi:

```bash
    git clone https://github.com/ardipermana59/test-trasindo
    copy .env.example .env
    
    npm run dev 
    php artisan serve

    php artisan migrate --seed
 ```

 ## Seed
 
User Superadmin
- email : superadmin@gmail.com
- password : password
 
User Merchant
- email : merchant1@gmail.com
- password : password
- email : merchant2@gmail.com
- password : password

User Customer
- email : customer1@gmail.com
- password : password
- email : customer2@gmail.com
- password : password