<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Author;
use App\Models\User;
use App\Services\PasswordResetService;
use Illuminate\Console\Command;

class PasswordResetsExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password_resets:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired password resets.';

    /**
     * Execute the console command.
     *
     * @param PasswordResetService $resetService
     *
     * @return void
     */
    public function handle(PasswordResetService $resetService): void
    {
        $resetService->deleteExpiredPasswordResets(Admin::class);
        $resetService->deleteExpiredPasswordResets(Author::class);
        $resetService->deleteExpiredPasswordResets(User::class);
    }
}
