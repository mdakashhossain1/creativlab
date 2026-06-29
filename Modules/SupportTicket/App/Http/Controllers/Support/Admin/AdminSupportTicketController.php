<?php

namespace Modules\SupportTicket\App\Http\Controllers\Support\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SupportTicket\App\Models\SupportTicket;
use Modules\SupportTicket\App\Models\MessageDocument;
use Modules\SupportTicket\App\Models\SupportTicketMessage;

class AdminSupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $support_tickets = SupportTicket::with('user')->latest()->get();

        return view('supportticket::support.admin.index', [
            'support_tickets' => $support_tickets
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $support_ticket = SupportTicket::with('user')->where('id', $id)->firstOrFail();

        $ticket_messages = SupportTicketMessage::with('documents', 'message_user')->where('support_ticket_id', $support_ticket->id)->get();
        $last_message = SupportTicketMessage::with('documents')->where('support_ticket_id', $support_ticket->id)->latest()->first();

        // Mark all user messages as seen when admin views the ticket
        SupportTicketMessage::where('support_ticket_id', $support_ticket->id)
            ->where('send_by', 'user')
            ->where('is_seen', 0)
            ->update(['is_seen' => 1]);

        return view('supportticket::support.admin.show', [
            'support_ticket' => $support_ticket,
            'ticket_messages' => $ticket_messages,
            'last_message' => $last_message,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function support_ticket_message(Request $request, $id)
    {
        $request->validate(
            [
                'message'      => 'required',
                'documents'    => 'nullable|array|max:5',
                'documents.*'  => 'file|mimes:pdf,jpg,jpeg,png,gif,doc,docx,zip|max:5120',
            ],
            [
                'message.required'   => 'Message is required',
                'documents.*.mimes'  => 'Only pdf, jpg, jpeg, png, gif, doc, docx, zip files are allowed',
                'documents.*.max'    => 'Each file must not exceed 5MB',
            ]
        );

        $user = Auth::guard('admin')->user();

        $support_ticket = SupportTicket::where('id', $id)->firstOrFail();

        $ticket_message = new SupportTicketMessage();
        $ticket_message->support_ticket_id = $support_ticket->id;
        $ticket_message->message = $request->message;
        $ticket_message->message_user_id = $user->id;
        $ticket_message->send_by = 'admin';
        $ticket_message->is_seen = 0; // Mark as unseen for user
        $ticket_message->save();

        if ($request->hasFile('documents')) {
            foreach ($request->documents as $index => $request_file) {
                $document = new MessageDocument();
                $document->message_id = $ticket_message->id;
                $document->file_name = app(\App\Services\UploadManager::class)->upload($request_file, 'uploads/custom-images', ['prefix' => 'support-ticket']);
                $document->model_name = 'SupportTicketMessage';
                $document->save();
            }
        }

        $notify_message = 'Message sent successfully';
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }

    public function close($id)
    {
        $support_ticket = SupportTicket::where('id', $id)->firstOrFail();
        $support_ticket->status = 'closed';
        $support_ticket->save();

        $notify_message = 'Ticket closed successfully';
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->route('admin.support-tickets')->with($notify_message);
    }

    public function destroy($id)
    {

        $support_ticket = SupportTicket::where('id', $id)->firstOrFail();

        $ticket_messages = SupportTicketMessage::with('documents')->where('support_ticket_id', $support_ticket->id)->get();

        foreach ($ticket_messages as $ticket_message) {

            $documents = MessageDocument::where('message_id', $ticket_message->id)->where('model_name', 'SupportTicketMessage')->get();
            foreach ($documents as $document) {
                if ($document->file_name) {
                    app(\App\Services\UploadManager::class)->delete($document->file_name);
                }

                $document->delete();
            }

            $ticket_message->delete();
        }

        $support_ticket->delete();


        $notify_message = 'Ticket deleted successfully';
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->route('admin.support-tickets')->with($notify_message);
    }
}
