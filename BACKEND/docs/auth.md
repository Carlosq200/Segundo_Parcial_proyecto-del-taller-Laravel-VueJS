# Autenticación (Laravel Sanctum)

## Pasos para correr
1. Ir al backend:  
   C:\Users\calos\Desktop\LARAVEL-PARCIAL\LARAVEL-API-CARLOS\BACKEND
2. Migraciones:  
   php artisan migrate --force
3. Crear/actualizar usuario admin:  
   php artisan tinker --execute "App\Models\User::updateOrCreate(['email'=>'admin@demo.com'], ['name'=>'Admin','password'=>bcrypt('password')]);"
4. Levantar servidor:  
   php artisan serve --host=127.0.0.1 --port=8002

## Pruebas rápidas
- GET  /api/ping → **200** { "ok": true }
- GET  /api/clientes (sin token) → **401**
- POST /api/login (form) → **{ token: "…" }**
- GET  /api/clientes con Authorization: Bearer <token> → **200**

## Notas
- El token es de Sanctum (personal access token).
- El CRUD de clientes está protegido con uth:sanctum.