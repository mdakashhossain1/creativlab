# Attendance Actions Dropdown Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace the inline action buttons in the daily attendance list view with a dropdown Actions menu matching the client projects table pattern.

**Architecture:** Update the actions column in `index.blade.php` to use the standard Bootstrap `.dropdown` structure with `data-bs-flip="false"` and unique IDs.

**Tech Stack:** PHP, Laravel Blade, HTML/CSS (Bootstrap 5, FontAwesome)

## Global Constraints
- Replicate the exact markup style and CSS class usage from the client projects dropdown list view.
- Preserve all existing attributes and JS event handlers (`onclick="openManual(...)"`).

---

### Task 1: Replace Actions Column in Attendance Index

**Files:**
- Modify: [index.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Attendance/resources/views/index.blade.php#L131-L140)

**Interfaces:**
- Consumes: Blade template variables `$team` and `$date`.
- Produces: Updated table layout with a functioning Bootstrap 5 dropdown button and menu.

- [ ] **Step 1: Replace the table cell with the new dropdown markup**

Modify [index.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Attendance/resources/views/index.blade.php#L131-L140):

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

- [ ] **Step 2: Commit the changes**

Run command:
```powershell
git add Modules/Attendance/resources/views/index.blade.php docs/superpowers/specs/2026-06-26-attendance-dropdown-design.md
git commit -m "feat: replace inline action buttons with standard dropdown in attendance index"
```
