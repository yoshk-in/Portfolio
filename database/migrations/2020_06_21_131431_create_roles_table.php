<?php

use App\model\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    protected $table = 'roles';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->integer('role');
        });

        $this->setAppUserRoles();
    }

    protected function setAppUserRoles()
    {
        foreach (Role::ROLES as $DBrole => $userRole) {
            (new Role(['role' => $DBrole]))->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
