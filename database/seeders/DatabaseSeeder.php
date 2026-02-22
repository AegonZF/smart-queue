<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'administrador',
        ]);

        User::factory()->create([
            'name' => 'Operador User',
            'email' => 'operador@example.com',
            'role' => 'operador',
        ]);

        User::factory()->create([
            'name' => 'Cliente User',
            'email' => 'cliente@example.com',
            'role' => 'cliente',
        ]);
    }
}

if (Auth::user()->isAdmin()) {
    return redirect('/admin/dashboard');
} elseif (Auth::user()->isOperador()) {
    return redirect('/operador/dashboard');
} else {
    return redirect('/cliente/dashboard');
}
