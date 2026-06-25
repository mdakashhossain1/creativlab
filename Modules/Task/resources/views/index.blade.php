@extends('admin.master_layout')
@section('title')<title>{{ __('Todo List') }}</title>@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Todo List') }}</h3>
    <p class="crancy-header__text">{{ __('Tasks') }} >> {{ __('My Tasks') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row mg-top-30">

            {{-- Left Sidebar --}}
            <div class="col-xl-3 col-lg-4 col-12 mb-4">
                <div class="crancy-product-card" style="padding:0;overflow:hidden;">

                    <div style="padding:20px 20px 12px;">
                        <h5 style="font-weight:700;font-size:15px;margin:0;display:flex;align-items:center;gap:8px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 11L12 14L22 4" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H16" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            {{ __('Todo List') }}
                        </h5>
                    </div>

                    <nav style="padding:0 8px 12px;">
                        @foreach([
                            ['inbox',     'Inbox',     'fa-inbox',      '#4f46e5'],
                            ['done',      'Done',      'fa-check-circle','#22c55e'],
                            ['important', 'Important', 'fa-star',       '#f59e0b'],
                            ['trash',     'Trash',     'fa-trash',      '#ef4444'],
                        ] as [$key, $label, $icon, $color])
                        <a href="{{ route('admin.tasks.index', ['status' => $key]) }}"
                            style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;text-decoration:none;margin-bottom:2px;transition:background .15s;color:{{ $status === $key ? $color : '#374151' }};background:{{ $status === $key ? ($key === 'inbox' ? '#ede9fe' : ($key === 'done' ? '#dcfce7' : ($key === 'important' ? '#fef3c7' : '#fee2e2'))) : 'transparent' }};"
                            onmouseover="if('{{ $status }}' !== '{{ $key }}') this.style.background='#f9fafb'"
                            onmouseout="if('{{ $status }}' !== '{{ $key }}') this.style.background='transparent'">
                            <i class="fas {{ $icon }}" style="width:16px;text-align:center;font-size:14px;"></i>
                            <span style="flex:1;font-size:14px;font-weight:{{ $status === $key ? '600' : '400' }};">{{ __($label) }}</span>
                            <span style="background:{{ $status === $key ? $color : '#e5e7eb' }};color:{{ $status === $key ? '#fff' : '#6b7280' }};border-radius:999px;min-width:22px;height:22px;padding:0 6px;font-size:11px;font-weight:700;display:inline-flex;align-items:center;justify-content:center;font-variant-numeric:tabular-nums;">
                                {{ $counts[$key] }}
                            </span>
                        </a>
                        @endforeach
                    </nav>

                    <div style="border-top:1px solid #f3f4f6;padding:12px 8px 8px;">
                        <p style="font-size:11px;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:.8px;padding:0 12px;margin-bottom:8px;">{{ __('Priority') }}</p>
                        @foreach([
                            ['all',    'All',    '#6b7280'],
                            ['high',   'High',   '#ef4444'],
                            ['medium', 'Medium', '#f59e0b'],
                            ['low',    'Low',    '#22c55e'],
                        ] as [$pval, $plabel, $pcolor])
                        <a href="{{ route('admin.tasks.index', ['status' => $status, 'priority' => $pval === 'all' ? null : $pval]) }}"
                            style="display:flex;align-items:center;gap:10px;padding:8px 12px;border-radius:8px;text-decoration:none;margin-bottom:2px;color:#374151;font-size:13px;"
                            onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                            <span style="width:10px;height:10px;border-radius:50%;background:{{ $pcolor }};flex-shrink:0;"></span>
                            {{ __($plabel) }}
                        </a>
                        @endforeach
                    </div>

                    <div style="padding:12px 16px 16px;">
                        <button type="button" class="crancy-btn" style="width:100%;justify-content:center;gap:8px;display:flex;align-items:center;transition:transform .1s ease;"
                            data-bs-toggle="modal" data-bs-target="#taskModal" onclick="openTaskModal()"
                            onmousedown="this.style.transform='scale(0.97)'" onmouseup="this.style.transform='scale(1)'" onmouseleave="this.style.transform='scale(1)'">
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M8 1V15" stroke="white" stroke-width="2.5" stroke-linecap="round"/><path d="M1 8H15" stroke="white" stroke-width="2.5" stroke-linecap="round"/></svg>
                            {{ __('Add New Task') }}
                        </button>
                    </div>

                </div>
            </div>

            {{-- Task List --}}
            <div class="col-xl-9 col-lg-8 col-12">
                <div class="crancy-product-card" style="padding:0;overflow:hidden;">

                    {{-- Toolbar --}}
                    <div style="padding:16px 20px;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                        <form method="GET" action="{{ route('admin.tasks.index') }}" style="flex:1;min-width:200px;display:flex;gap:8px;">
                            <input type="hidden" name="status" value="{{ $status }}">
                            <div style="position:relative;flex:1;">
                                <input type="text" name="search" value="{{ $search }}" placeholder="{{ __('Search tasks...') }}"
                                    class="crancy__item-input" style="padding-left:36px;height:40px;font-size:13px;">
                                <i class="fas fa-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:13px;"></i>
                            </div>
                            <button type="submit" class="crancy-btn" style="height:40px;padding:0 16px;font-size:13px;">{{ __('Search') }}</button>
                        </form>
                        <div style="font-size:13px;color:#9ca3af;white-space:nowrap;font-variant-numeric:tabular-nums;">
                            {{ $tasks->total() }} {{ __('tasks') }}
                        </div>
                    </div>

                    {{-- Task Rows --}}
                    <div>
                        @forelse($tasks as $task)
                        <div class="task-row" style="display:flex;align-items:flex-start;gap:12px;padding:14px 20px;border-bottom:1px solid #f9fafb;transition:background .12s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='transparent'">

                            {{-- Checkbox --}}
                            <form action="{{ route('admin.tasks.toggle-complete', $task->id) }}" method="POST" style="padding-top:2px;flex-shrink:0;">
                                @csrf
                                <button type="submit" style="background:none;border:2px solid {{ $task->status === 'done' ? '#22c55e' : '#d1d5db' }};border-radius:6px;width:20px;height:20px;cursor:pointer;display:flex;align-items:center;justify-content:center;padding:0;transition:border-color .15s,background .15s;"
                                    onmouseover="this.style.borderColor='#22c55e'" onmouseout="this.style.borderColor='{{ $task->status === 'done' ? '#22c55e' : '#d1d5db' }}'">
                                    @if($task->status === 'done')
                                        <svg width="11" height="11" viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    @endif
                                </button>
                            </form>

                            {{-- Content --}}
                            <div style="flex:1;min-width:0;">
                                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:3px;">
                                    <span style="font-size:14px;font-weight:600;color:#111827;{{ $task->status === 'done' ? 'text-decoration:line-through;color:#9ca3af;' : '' }}">
                                        {{ $task->title }}
                                    </span>
                                    {{-- Priority badge --}}
                                    <span style="font-size:11px;font-weight:600;padding:1px 8px;border-radius:999px;background:{{ $task->priority === 'high' ? '#fee2e2' : ($task->priority === 'low' ? '#dcfce7' : '#fef3c7') }};color:{{ $task->priority === 'high' ? '#dc2626' : ($task->priority === 'low' ? '#16a34a' : '#d97706') }};">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                    {{-- Tags --}}
                                    @foreach($task->tags_list as $tag)
                                        <span style="font-size:11px;padding:1px 8px;border-radius:999px;background:#ede9fe;color:#4f46e5;">{{ $tag }}</span>
                                    @endforeach
                                    {{-- Meeting badge --}}
                                    @if($task->meeting_at)
                                        <span style="font-size:11px;padding:1px 8px;border-radius:999px;background:#dbeafe;color:#1d4ed8;display:inline-flex;align-items:center;gap:4px;">
                                            <i class="fas fa-calendar-alt" style="font-size:10px;"></i>
                                            {{ $task->meeting_at->format('d M, h:i A') }}
                                        </span>
                                    @endif
                                </div>
                                @if($task->description)
                                <p style="margin:0;font-size:12px;color:#9ca3af;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:560px;">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($task->description), 100) }}
                                </p>
                                @endif
                            </div>

                            {{-- Date --}}
                            <div style="font-size:12px;color:#9ca3af;white-space:nowrap;flex-shrink:0;padding-top:2px;font-variant-numeric:tabular-nums;">
                                {{ $task->created_at->format('M d, Y') }}
                            </div>

                            {{-- Actions --}}
                            <div class="dropdown" style="flex-shrink:0;">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="background:none;border:none;padding:4px 8px;color:#9ca3af;font-size:16px;line-height:1;border-radius:6px;transition:background .12s,color .12s;"
                                    onmouseover="this.style.background='#f3f4f6';this.style.color='#374151'"
                                    onmouseout="this.style.background='none';this.style.color='#9ca3af'">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="#" class="dropdown-item" onclick="openTaskModal({{ $task->id }}, {{ json_encode($task) }})">
                                            <i class="fas fa-edit me-2"></i>{{ __('Edit') }}
                                        </a>
                                    </li>
                                    @if($task->status !== 'important')
                                    <li>
                                        <form action="{{ route('admin.tasks.move', $task->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="important">
                                            <button type="submit" class="dropdown-item"><i class="fas fa-star me-2 text-warning"></i>{{ __('Mark Important') }}</button>
                                        </form>
                                    </li>
                                    @endif
                                    @if($task->status !== 'trash')
                                    <li>
                                        <form action="{{ route('admin.tasks.move', $task->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="trash">
                                            <button type="submit" class="dropdown-item text-warning"><i class="fas fa-archive me-2"></i>{{ __('Move to Trash') }}</button>
                                        </form>
                                    </li>
                                    @endif
                                    @if($task->status === 'trash')
                                    <li>
                                        <form action="{{ route('admin.tasks.move', $task->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="inbox">
                                            <button type="submit" class="dropdown-item"><i class="fas fa-undo me-2"></i>{{ __('Restore') }}</button>
                                        </form>
                                    </li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('{{ __('Delete this task permanently?') }}')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"><i class="fas fa-trash me-2"></i>{{ __('Delete Permanently') }}</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        @empty
                        <div style="padding:48px;text-align:center;">
                            <i class="fas fa-clipboard-list" style="font-size:36px;color:#d1d5db;display:block;margin-bottom:12px;"></i>
                            <p style="color:#9ca3af;margin:0;">{{ __('No tasks yet.') }}</p>
                            <button type="button" class="crancy-btn mt-3" data-bs-toggle="modal" data-bs-target="#taskModal" onclick="openTaskModal()" style="font-size:13px;">
                                {{ __('Create your first task') }}
                            </button>
                        </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if($tasks->hasPages())
                    <div style="padding:16px 20px;border-top:1px solid #f3f4f6;">
                        {{ $tasks->links() }}
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</section>

{{-- Add / Edit Task Modal --}}
<div class="modal fade" id="taskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:1px solid #f3f4f6;">
                <h5 class="modal-title" id="taskModalTitle">{{ __('Add New Task') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="taskForm" method="POST">
                @csrf
                <span id="taskMethodField"></span>
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-12">
                            <div class="crancy__item-form--group">
                                <label class="crancy__item-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="taskTitle" class="crancy__item-input" required placeholder="{{ __('Task title...') }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="crancy__item-form--group">
                                <label class="crancy__item-label">{{ __('Description') }}</label>
                                <textarea name="description" id="taskDescription" class="crancy__item-input" rows="3" style="resize:vertical;" placeholder="{{ __('Optional details...') }}"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="crancy__item-form--group">
                                <label class="crancy__item-label">{{ __('Priority') }}</label>
                                <select name="priority" id="taskPriority" class="form-select crancy__item-input">
                                    <option value="low">{{ __('Low') }}</option>
                                    <option value="medium" selected>{{ __('Medium') }}</option>
                                    <option value="high">{{ __('High') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="crancy__item-form--group">
                                <label class="crancy__item-label">{{ __('Tags') }} <small class="text-muted">({{ __('comma separated') }})</small></label>
                                <input type="text" name="tags" id="taskTags" class="crancy__item-input" placeholder="Team, Update, ...">
                            </div>
                        </div>

                        <div class="col-12">
                            <div style="background:#f0f4ff;border-radius:10px;padding:16px 18px;">
                                <p style="margin:0 0 12px;font-weight:600;font-size:13px;color:#4f46e5;display:flex;align-items:center;gap:6px;">
                                    <i class="fas fa-calendar-alt"></i> {{ __('Schedule Meeting') }} <span style="font-weight:400;color:#6b7280;">({{ __('optional') }})</span>
                                </p>
                                <div class="row g-3">
                                    <div class="col-md-7">
                                        <label class="crancy__item-label">{{ __('Meeting Date & Time') }}</label>
                                        <input type="datetime-local" name="meeting_at" id="taskMeetingAt" class="crancy__item-input" style="height:42px;">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="crancy__item-label">{{ __('Remind Me Before') }}</label>
                                        <select name="notify_before_minutes" id="taskNotifyBefore" class="form-select crancy__item-input" style="height:42px;">
                                            <option value="15">15 {{ __('minutes') }}</option>
                                            <option value="30" selected>30 {{ __('minutes') }}</option>
                                            <option value="60">1 {{ __('hour') }}</option>
                                            <option value="120">2 {{ __('hours') }}</option>
                                            <option value="1440">1 {{ __('day') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <p style="margin:0;font-size:12px;color:#6b7280;">
                                            <i class="fas fa-info-circle me-1"></i>{{ __('You will receive an email reminder before the meeting and again when it starts.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #f3f4f6;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="crancy-btn" style="min-width:120px;">
                        <i class="fas fa-save me-1"></i> <span id="taskSubmitLabel">{{ __('Save Task') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js_section')
<script>
function openTaskModal(id, task) {
    const form   = document.getElementById('taskForm');
    const method = document.getElementById('taskMethodField');
    const title  = document.getElementById('taskModalTitle');
    const submit = document.getElementById('taskSubmitLabel');

    if (id && task) {
        // Edit mode
        title.textContent  = '{{ __("Edit Task") }}';
        submit.textContent = '{{ __("Update Task") }}';
        form.action        = '{{ url("admin/tasks") }}/' + id;
        method.innerHTML   = '<input type="hidden" name="_method" value="PUT">';

        document.getElementById('taskTitle').value       = task.title || '';
        document.getElementById('taskDescription').value = task.description || '';
        document.getElementById('taskPriority').value    = task.priority || 'medium';
        document.getElementById('taskTags').value        = (task.tags || []).join(', ');
        document.getElementById('taskNotifyBefore').value = task.notify_before_minutes || 30;

        if (task.meeting_at) {
            // Convert to datetime-local format (YYYY-MM-DDTHH:MM)
            var mt = task.meeting_at.replace(' ', 'T').substring(0, 16);
            document.getElementById('taskMeetingAt').value = mt;
        } else {
            document.getElementById('taskMeetingAt').value = '';
        }
    } else {
        // Create mode
        title.textContent  = '{{ __("Add New Task") }}';
        submit.textContent = '{{ __("Save Task") }}';
        form.action        = '{{ route("admin.tasks.store") }}';
        method.innerHTML   = '';
        form.reset();
        document.getElementById('taskPriority').value     = 'medium';
        document.getElementById('taskNotifyBefore').value = '30';
    }
}
</script>
@endpush
