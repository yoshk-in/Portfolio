<?php

namespace App\Console\Commands;

use App\model\Role;
use App\model\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class SetAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:admin {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'grant user admin permissions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userId = $this->argument('userId');
        /** @var User $user */
        $user = User::find($userId);
        if (!$user) {
            throw new ModelNotFoundException(sprintf("user with id %s not found", $userId));
        }
        $newRole = $user->addNewRole(Role::ADMIN);
        $user->push();

        $this->info(sprintf("user %s (id = %s) has been set as %s", $user->name, $user->id, $newRole->role));
    }
}
