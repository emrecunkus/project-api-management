Bu proje Laravel Sail tabanlı bir Docker ortamında çalışacak şekilde yapılandırılmıştır.


->Gereksinimler 
-Docker
-Docker Compose (Docker Desktop ile birlikte gelir)
-Laravel Sail (proje içinde yüklüdür)

Kurulum Adımları aşağıdaki gibidir. 
1. Projeyi klonla
git clone https://github.com/emrecunkus/project-api-management.git project_api_management
cd project_api_management

2.Ortam dosyasını oluştur. 
cp .env.example .env

3.Bağımlıkları yükle; 
sudo apt install php8.4-xml (kendi versiyonunuza göre değişebilir)

composer install 

4. Uygulama set upları 
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate


Şunlar çalışacaktır. 
Laravel 
MySQL
Redis
Meilisearch
Mailpit
Selenium
PhpMyAdmin

Migration ve sedeleri çalıştır.. 
./vendor/bin/sail artisan migrate:fresh --seed

Örnek Giriş Bilgileri 
Rol-E-posta-	Şifre
Admin	admin@example.com	password
Customer	customer@example.com	password

Örnek bir postman testi->>> Giriş Yap (Token Al) 

POST /api/login 
Content-Type: application/json

{
  "email": "admin@example.com",
  "password": "password"
}
->>>Dönen cevap içindeki token değerini kopyalayın.

->>> Token ile Korunan API’leri Test Et
Postman’de Authorization sekmesinden:

Type: Bearer Token

Token: (Girişte aldığın token)

-> Postman Koleksiyonu
Postman'i açın

"Import" > "File" > postman_collection.json dosyasını seçin

Login endpoint'i ile token alın

Diğer isteklerde Bearer Token kullanarak API'yi test edin

Servis	Adres
Uygulama->>	http://localhost
PhpMyAdmin->>	http://localhost:8081

Test
API endpointlerini test etmek için Postman koleksiyonu kullanabilirsiniz. Proje ana dizininde mevcuttur.





