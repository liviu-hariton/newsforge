<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminProfileRequest;
use App\Models\User;
use App\Traits\FileDelete;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    use FileDelete;

    /**
     * Get the available sections for the admin user profile
     * as defined in the AdminProfileController
     *
     * @return array
     */
    public static function profileSections()
    {
        return [
            'personal' => [
                'icon' => '<i class="mdi mdi-account-outline mr-1"></i>',
                'name' => 'Personal details'
            ],
            'public' => [
                'icon' => '<i class="mdi mdi-account-box mr-1"></i>',
                'name' => 'Public details'
            ],
            'security' => [
                'icon' => '<i class="mdi mdi-settings-outline mr-1"></i>',
                'name' => 'Security settings'
            ],
            'notifications' => [
                'icon' => '<i class="mdi mdi-bell-outline mr-1"></i>',
                'name' => 'Notifications'
            ],
            'preferences' => [
                'icon' => '<i class="mdi mdi-cogs mr-1"></i>',
                'name' => 'Preferences'
            ]
        ];
    }

    public function __call($method, $parameters)
    {
        $profile_data = User::with('adminProfile')->find(auth()->user()->id);

        return view('backend.profile.'.$method, [
            'data' => $profile_data->adminProfile
        ])->render();
    }

    public function updateProfile(AdminProfileRequest $request)
    {
        $validated = $request->validated();

        if($request->hasFile('avatar')) {
            $validated['avatar'] = $this->uploadFile($request, 'avatar', 'avatars', 'public');
        }

        if($request->hasFile('public_avatar')) {
            $validated['public_avatar'] = $this->uploadFile($request, 'public_avatar', 'avatars', 'public');
        }

        $user = User::find(auth()->user()->id);

        $user->adminProfile()->updateOrCreate([], $validated);

        return redirect()->route('admin.profile.'.$request->section)->with('success', 'Details updated successfully');
    }
}
