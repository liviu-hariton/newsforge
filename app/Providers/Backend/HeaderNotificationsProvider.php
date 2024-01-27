<?php

namespace App\Providers\Backend;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HeaderNotificationsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('backend.components.header', function($view) {
            $unread_notifications = [];

            if(Auth::check()) {
                $unread_notifications = $this->prepareNotifications();
            }

            $view->with('unread_notifications', $unread_notifications);
        });
    }

    private function prepareNotifications(): array
    {
        $notifications = [];

        $unread_notifications = auth()->user()->unreadNotifications()->limit(5)->get();

        foreach($unread_notifications as $unread_notification) {
            $notification_details = $this->getNotificationDetails($unread_notification);

            $notifications[] = [
                'id' => $unread_notification->id,
                'entity_id' => $unread_notification->data['contact_id'],
                'title' => $notification_details['title'],
                'description' => $notification_details['description'],
                'action' => $notification_details['action'],
                'icon' => $notification_details['icon'],
                'created_ago' => Carbon::parse($unread_notification->created_at)->ago()
            ];
        }

        return $notifications;
    }

    private function getNotificationDetails($notification): array
    {
        $details = [];

        if(str_ends_with($notification->type, 'NewContact')) {
            $contact = Contact::find($notification->data['contact_id']);

            if($contact) {
                $details['title'] = 'New contact form submitted';
                $details['description'] = $contact->subject;
                $details['action'] = route('admin.contact.show', $contact);
                $details['icon'] = '<i class="bi bi-envelope-at"></i>';
            }
        }

        return $details;
    }
}
