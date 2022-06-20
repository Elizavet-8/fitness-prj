<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationStoreRequest;
use App\Http\Requests\NotificationUpdateRequest;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::all();
        return response()->json($notifications);
    }

    public function list()
    {
        $notifications = Notification::all();

        return view('admin.dashboard.notification.notificationList')->with(compact('notifications'));
    }

    public function store(NotificationStoreRequest $request)
    {
        $notification = Notification::create($request->validated());
        return new NotificationResource($notification);
    }

    public function show(Request $request, $notificationId)
    {
        $user = Auth::user()->id;
        $notification = Notification::find($notificationId);
        if ($notification->user_id == $user)
            return new NotificationResource($notification);
        return new NotificationResource();
    }

    public function update(NotificationUpdateRequest $request, $notificationId)
    {
        $user = Auth::user()->id;
        $notification = Notification::find($notificationId);
        if ($notification->user_id == $user) {
            $notification->update($request->validated());
            return new NotificationResource($notification);
        }
        return new NotificationResource();
    }

    public function destroy(Request $request, $notificationId)
    {
        $user = Auth::user()->id;
        $notification = Notification::find($notificationId);
        if ($notification->user_id == $user)
            $notification->delete();
        return response()->noContent();

        $notification = Notification::find($id);

        $notification->delete();

        return redirect()->route('admin.dashboard.notification.notificationList')
            ->with('success', 'Deleted successfully');
    }

    function adminShowNotification(Request $request, $id)
    {
        $notification = Notification::find($id);

        return view('admin.dashboard.notification.notificationEditForm')->with(compact('notification'));
    }

    public function editNotification(Request $request, $id)
    {
        $notification = Notification::find($id);
        $input = $request->validate([
            'name' => 'required|string',
            'day' => 'required|integer',
            'description' => 'string'
        ]);
        $notification->update($input);
        return redirect()->route('notification');
    }

    function adminAddView(Request $request)
    {
        $notifications = Notification::all();
        return view('admin.dashboard.notification.notificationAdd')->with(compact('notifications'));
    }

    public function addNotification(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'day' => 'required|integer',
            'description' => 'string'
        ]);
        Notification::create($input);
        return redirect()->route('notification');
    }

    public function deleteNotification($id)
    {
        Notification::destroy($id);
    }
}
