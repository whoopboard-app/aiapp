<?php

namespace App\Modules\Workspace\Controllers;

use App\Http\Controllers\Controller;

class WorkspaceController extends Controller
{
    public function dashboard()
    {
        return view('workspace.dashboard');
    }
}
