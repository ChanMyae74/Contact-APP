<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\ContactQueue;
use App\Models\User;
use App\Notifications\ContactShareNoti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MiscController extends Controller
{
    public function showTrash()
    {
        $contacts = Contact::onlyTrashed()->where("user_id", auth()->user()->id)->get();
        return view('showTrash', ["contacts" => $contacts]);
    }

    public function permanentDelete($id)
    {
        $contact = Contact::onlyTrashed()->find($id);
        Storage::delete("public/photo/" . $contact->photo);
        $contact->forceDelete();
        return redirect()->back()->with("status", "Contact is permanently deleted");
    }

    public function bulkDelete(Request $request)
    {

        $bulkChecks =  $request->bulkChecks;
        foreach ($bulkChecks as $value) {
            $contact = Contact::find($value);
            // return $contact;
            $contact->delete();
        };


        return redirect()->route("contact.index")->with("status", "Contacts were moved to trash");
    }

    public function bulkAction(Request $request)
    {

        if (request('action') === "delete") {
            $contacts =  Contact::onlyTrashed()->whereIn("id", $request->bulkChecks);
            foreach ($contacts->get() as $contact) {
                Storage::delete("public/photo/" . $contact->photo);
            }
            $contacts->forceDelete();
            return redirect()->route("showTrash")->with("status", "Contact permanently deleted");
        }
        Contact::onlyTrashed()->whereIn("id", $request->bulkChecks)->restore();
        return redirect()->route("showTrash")->with("status", "Contact restored");
    }

    public function sendContact(Request $request)
    {
        // return $request;
        $request->validate([
            "contact_ids" => "required",
            "receiver_email" => "required"
        ]);
        $receiver_user = User::where("email", $request->receiver_email)->first();
        $contact_ids = request("contact_ids");
        if (is_null($receiver_user)) {
            return redirect()->route("contact.index")->with(["status" => "No user with such email address", "icon" => "error"]);
        }
        $contactQueue = new ContactQueue();
        $contactQueue->contact_ids = json_encode($contact_ids);
        $contactQueue->sender_id = Auth::id();
        $contactQueue->receiver_id = $receiver_user->id;
        $contactQueue->message = $request->message;
        $contactQueue->save();
        // foreach ($contact_ids as $contact_id) {
        //     $sender_id = Auth::id();
        //     $receiver_id = $receiver_user->id;
        //     ContactQueue::create([
        //         "contact_id" => $contact_id,
        //         "sender_id" => $sender_id,
        //         "receiver_id" => $receiver_id,
        //         "message" => $request->message,
        //     ]);
        // };
        $receiver_user->notify(new ContactShareNoti(Auth::user()->name, $request->message, route("contactQueue", $contactQueue->id), $receiver_user->email));
        return redirect()->route("contact.index")->with("status", "Contact sent successfully");
    }

    public function contactQueue($id)
    {
        $contactQueues = ContactQueue::find($id);
        if ($contactQueues->status) {
            return abort(404);
        };

        $contactNumber = Contact::find(json_decode($contactQueues->contact_ids))->count();
        $contacts = Contact::find(json_decode($contactQueues->contact_ids));

        $noti = Auth::user()->notifications->where("notifiable_id", $contactQueues->receiver_id)->first();
        $noti->markAsRead();

        return view("contactQueue", ["contactQueue" => $contactQueues, "contactNumber" => $contactNumber, "contacts" => $contacts]);
    }

    public function acceptContact(Request $request, $id)
    {
        $contact_ids = json_decode(ContactQueue::find($id)->contact_ids);


        Contact::whereIn("id", $contact_ids)
            ->update(["user_id" => Auth::id()]);

        ContactQueue::find($id)->update(["status" => "accept"]);
        // $contact_id = $request->contact_id;
        // $receiver_id = Auth::id();
        // $contact = Contact::find($contact_id);
        // if (isset(pathinfo(asset("storage/photo/" . $contact->photo))["extension"])) {
        //     $newPhotoName = uniqid() . "-photo." . pathinfo(asset("storage/photo/" . $contact->photo))["extension"];
        //     Storage::copy("public/photo/" . $contact->photo, "public/photo/" . $newPhotoName);
        //     $contact->replicate()->fill(["user_id" => $receiver_id, "photo" => $newPhotoName])->save(); //duplicate record with updated user_id
        //     ContactQueue::where("contact_id", $contact_id)->where("receiver_id", Auth::id())->delete(); //delete queue record
        // } else {
        //     $contact->replicate()->fill(["user_id" => $receiver_id])->save(); //duplicate record with updated user_id
        //     ContactQueue::where("contact_id", $contact_id)->where("receiver_id", Auth::id())->delete(); //delete queue record
        // }
        return redirect()->route("contact.index")->with("status", "Contact accept successfully");
    }

    public function denyContact($id)
    {
        $contact_ids = json_decode(ContactQueue::find($id)->contact_ids);
        ContactQueue::find($id)->update(["status" => "deny"]);
        return redirect()->route("contact.index")->with("status", "Contact is denied successfully");
    }

    public function notifications()
    {
        $notis = Auth::user()->notifications;
        return view("notifications", ["notis" => $notis]);
    }

    public function notificationsRead($id)
    {
        $noti = Auth::user()->notifications->where("id", $id)->first();
        $noti->markAsRead();
        return redirect()->back();
    }

    public function notificationsReadAll()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with("status", "All are now read");
    }
}
