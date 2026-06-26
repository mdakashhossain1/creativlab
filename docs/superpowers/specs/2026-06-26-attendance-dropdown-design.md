# Attendance Actions Dropdown Design

Replace inline action buttons in the daily attendance table with a Bootstrap dropdown list, matching the design pattern from the Client Projects section.

## Analysis of Existing Pattern

In the **Client Projects** list view (`Modules/Subscription/Resources/views/admin/client-projects/index.blade.php`), dropdowns are structured as follows:
- The dropdown container uses the `.dropdown` class.
- The toggle button has the `.crancy-btn` and `.dropdown-toggle` classes.
- The toggle button uses `data-bs-flip="false"` to prevent the menu from jumping/flipping in table layouts.
- It uses a unique dynamic ID: `id="dropdownMenuButton{{ $project->id }}"`.
- Each action is list-based (`<li>` inside a `.dropdown-menu`), containing a link with `.dropdown-item`.
- Inside the link is a standard FontAwesome icon followed by the translated action label.

We will replicate this exact pattern for the **Attendance** list view (`Modules/Attendance/resources/views/index.blade.php`).

## Proposed Changes

### [Attendance Module]

#### [MODIFY] [index.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Attendance/resources/views/index.blade.php)
Replace:
```html
<td>
    <button class="btn btn-sm btn-outline-primary"
        onclick="openManual({{ $team->id }}, '{{ $date }}', '{{ $att?->check_in }}', '{{ $att?->check_out }}', '{{ $att?->notes }}')">
        <i class="fas fa-edit"></i>
    </button>
    <a href="{{ route('admin.attendance.calendar', $team->id) }}" class="btn btn-sm btn-outline-secondary" title="Calendar">
        <i class="fas fa-calendar-alt"></i>
    </a>
</td>
```
With:
```html
<td>
    <div class="dropdown">
        <button class="crancy-btn dropdown-toggle" type="button"
            id="dropdownMenuButton{{ $team->id }}"
            data-bs-toggle="dropdown"
            data-bs-flip="false"
            aria-expanded="false">
            {{ __('Action') }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $team->id }}">
            <li>
                <a class="dropdown-item" href="javascript:;"
                    onclick="openManual({{ $team->id }}, '{{ $date }}', '{{ $att?->check_in }}', '{{ $att?->check_out }}', '{{ $att?->notes }}')">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('admin.attendance.calendar', $team->id) }}">
                    <i class="fas fa-calendar-alt"></i> {{ __('Calendar') }}
                </a>
            </li>
        </ul>
    </div>
</td>
```

## Verification Plan

### Manual Verification
- Navigate to `/admin/attendance` in a web browser.
- Verify that each row in the Attendance table has a dropdown button labeled **Action**.
- Click the dropdown button and check that it displays two items: **Edit** and **Calendar**.
- Click the **Edit** option and verify that the manual entry modal opens with correct inputs.
- Click the **Calendar** option and verify that you are redirected to the correct team member's attendance calendar view.
