<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Author;
use App\Models\User;
use App\Services\EmailConfirmService;
use Illuminate\Console\Command;

class EmailConfirmsExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email_confirms:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired email confirms.';

    /**
     * Execute the console command.
     *
     * @param EmailConfirmService $emailConfirmService
     *
     * @return void
     */
    public function handle(EmailConfirmService $emailConfirmService): void
    {
        $emailConfirmService->deleteExpiredEmailConfirms(Admin::class);
        $emailConfirmService->deleteExpiredEmailConfirms(Author::class);
        $emailConfirmService->deleteExpiredEmailConfirms(User::class);
    }
}
