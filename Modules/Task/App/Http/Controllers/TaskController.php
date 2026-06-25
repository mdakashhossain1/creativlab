<?php

namespace Modules\Task\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Task\App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'inbox');
        $search = $request->input('search');

        try {
            $query = Task::where('status', $status)->latest();

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }

            if ($request->filled('priority')) {
                $query->where('priority', $request->priority);
            }

            $tasks = $query->paginate(20)->withQueryString();

            $counts = [
                'inbox'     => Task::inbox()->count(),
                'done'      => Task::done()->count(),
                'important' => Task::important()->count(),
                'trash'     => Task::trash()->count(),
            ];
        } catch (\Throwable $e) {
            $tasks  = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
            $counts = ['inbox' => 0, 'done' => 0, 'important' => 0, 'trash' => 0];
        }

        return view('task::index', compact('tasks', 'counts', 'status', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'                  => 'required|string|max:255',
            'description'            => 'nullable|string',
            'priority'               => 'required|in:low,medium,high',
            'tags'                   => 'nullable|string',
            'meeting_at'             => 'nullable|date',
            'notify_before_minutes'  => 'nullable|integer|min:1|max:10080',
        ]);

        $tags = null;
        if ($request->filled('tags')) {
            $tags = array_values(array_filter(array_map('trim', explode(',', $request->tags))));
        }

        Task::create([
            'title'                 => $request->title,
            'description'           => $request->input('description', ''),
            'priority'              => $request->priority,
            'tags'                  => $tags,
            'status'                => 'inbox',
            'meeting_at'            => $request->meeting_at ?: null,
            'notify_before_minutes' => $request->input('notify_before_minutes', 30),
        ]);

        return redirect()->route('admin.tasks.index')
            ->with(['message' => __('Task created'), 'alert-type' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title'                  => 'required|string|max:255',
            'description'            => 'nullable|string',
            'priority'               => 'required|in:low,medium,high',
            'tags'                   => 'nullable|string',
            'meeting_at'             => 'nullable|date',
            'notify_before_minutes'  => 'nullable|integer|min:1|max:10080',
        ]);

        $tags = null;
        if ($request->filled('tags')) {
            $tags = array_values(array_filter(array_map('trim', explode(',', $request->tags))));
        }

        $newMeetingAt = $request->meeting_at ?: null;
        $resetReminder = $newMeetingAt && $newMeetingAt !== optional($task->meeting_at)->toDateTimeString();

        $task->update([
            'title'                 => $request->title,
            'description'           => $request->input('description', ''),
            'priority'              => $request->priority,
            'tags'                  => $tags,
            'meeting_at'            => $newMeetingAt,
            'notify_before_minutes' => $request->input('notify_before_minutes', 30),
            'reminder_sent_at'      => $resetReminder ? null : $task->reminder_sent_at,
            'meeting_notified_at'   => $resetReminder ? null : $task->meeting_notified_at,
        ]);

        return redirect()->route('admin.tasks.index', ['status' => $task->status])
            ->with(['message' => __('Task updated'), 'alert-type' => 'success']);
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->back()
            ->with(['message' => __('Task deleted'), 'alert-type' => 'success']);
    }

    public function toggleComplete($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => $task->status === 'done' ? 'inbox' : 'done']);
        return redirect()->back()
            ->with(['message' => __('Task updated'), 'alert-type' => 'success']);
    }

    public function move(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:inbox,important,trash']);
        Task::findOrFail($id)->update(['status' => $request->status]);
        return redirect()->back()
            ->with(['message' => __('Task moved'), 'alert-type' => 'success']);
    }
}
