<?php

namespace App\Http\Controllers;

use App\Models\Role;

class RoleController extends CrudController
{
    protected function model(): string { return Role::class; }
    protected function searchableFields(): array { return ['name']; }
}
