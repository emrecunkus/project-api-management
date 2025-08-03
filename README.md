# Project API Management

Bu proje, Laravel Sail tabanlı bir Docker ortamında çalışacak şekilde yapılandırılmıştır.

## Gereksinimler

- [Docker](https://www.docker.com/)
- Docker Compose (Docker Desktop ile birlikte gelir)
- Laravel Sail (proje içerisinde yüklüdür)

---

## Kurulum Adımları

### 1. Projeyi Klonla

```bash
git clone https://github.com/emrecunkus/project-api-management.git project_api_management
cd project_api_management
```

### 2. Ortam Dosyasını Oluştur

```bash
cp .env.example .env
```

### 3. Bağımlılıkları Yükle

Laravel Sail çalışabilmesi için PHP XML eklentisi gerekebilir:

```bash
sudo apt install php8.4-xml # PHP versiyonuna göre değişebilir
composer install
```

### 4. Uygulama Servislerini Başlat

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
```

### 5. Migration ve Seeder İşlemleri

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

---

## Çalışan Servisler

| Servis        | Adres                      |
|---------------|----------------------------|
| Laravel Uygulaması | http://localhost             |
| PhpMyAdmin    | http://localhost:8081      |
| Mailpit       | http://localhost:8025      |
| Meilisearch   | http://localhost:7700      |
| Selenium      | http://localhost:4444      |
| Redis         | Dahili (localhost:6379)    |
| MySQL         | Dahili (localhost:3306)    |

---

##  Örnek Giriş Bilgileri

| Rol     | E-posta              | Şifre     |
|---------|----------------------|-----------|
| Admin   | admin@example.com    | password  |
| Customer | customer@example.com | password  |

---

##  API Testi - Postman

### ➤ Giriş Yap (Token Al)

**Endpoint:**

```
POST /api/login
```

**Header:**

```json
Content-Type: application/json
```

**Body:**

```json
{
  "email": "admin@example.com",
  "password": "password"
}
```

Yanıt içerisindeki **token**'ı kopyalayın.

---

###  Token ile Korunan API’leri Test Et

**Postman Authorization:**

- **Type:** Bearer Token  
- **Token:** (Girişte aldığınız token)

---

###  Postman Koleksiyonu

1. Postman’i açın
2. `Import > File` seçin
3. `project_api_management.postman_collection.json` dosyasını yükleyin (proje ana dizininde yer alır)
4. Login endpoint’inden token alın
5. Diğer endpointleri Bearer Token ile test edin

---

##  Test

Tüm API endpointlerini test etmek için Postman koleksiyonunu kullanabilirsiniz.


