<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminProfileRequest;
use App\Models\User;
use App\Traits\FileDelete;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    use FileDelete, FileUpload;

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

        $user = auth()->user();
        $admin_profile = $user->adminProfile;

        if($request->hasFile('avatar')) {
            $this->updateAvatar($request, 'avatar', $admin_profile, $validated);
        }

        if($request->hasFile('public_avatar')) {
            $this->updateAvatar($request, 'public_avatar', $admin_profile, $validated);
        }

        $admin_profile->updateOrCreate([], $validated);

        return redirect()->route('admin.profile.'.$request->section)->with('success', 'Details updated successfully');
    }

    private function updateAvatar($request, $avatar_type, $adminProfile, &$validated_array)
    {
        $validated_array[$avatar_type] = $this->uploadFile($request, $avatar_type, 'avatars', 'public');

        if($validated_array[$avatar_type]) {
            $avatar_path = $adminProfile->$avatar_type;

            // delete previous avatar image file, if is set and exists
            if($adminProfile && $avatar_path && Storage::disk('public')->exists($avatar_path)) {
                $this->deleteFile($avatar_path, 'public');
            }
        }
    }
}
