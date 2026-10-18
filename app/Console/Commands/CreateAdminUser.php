<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    protected $signature = 'app:create-admin';

    protected $description = 'Create a super admin account';

    public function handle(): int
    {
        $name = trim((string) $this->ask('Nama admin'));
        $email = strtolower(trim((string) $this->ask('Email admin')));

        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Nama atau format email tidak valid.');
            return self::FAILURE;
        }

        if (User::where('email', $email)->exists()) {
            $this->error('Email sudah terdaftar. Tidak ada perubahan.');
            return self::FAILURE;
        }

        $password = $this->secret(
            'Password admin (minimal 12 karakter)'
        );
        $confirmation = $this->secret('Ulangi password');

        if (
            !is_string($password) ||
            strlen($password) < 12 ||
            $password !== $confirmation
        ) {
            $this->error('Password tidak cocok atau kurang dari 12 karakter.');
            return self::FAILURE;
        }

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->role = 'super_admin';
        $user->save();

        $this->info('Akun super admin berhasil dibuat.');
        $this->info('Email: ' . $user->email);

        return self::SUCCESS;
    }
}
