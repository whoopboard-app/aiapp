<?php

namespace App\Modules\Workspace\Controllers;

use App\Http\Controllers\Controller;

class WorkspaceSettingsController extends Controller
{
    public function show()
    {
        return view('workspace.settings');
    }

    public function update()
    {
        // TODO: Implement settings update
        return back()->with('success', 'Settings updated successfully.');
    }
}
