# Payroll Actions Dropdown Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace the inline buttons and form submissions in the daily payroll list view with a dropdown Actions menu matching the client projects table pattern.

**Architecture:** Update the actions column in the Payroll index Blade view to use a standard Bootstrap `.dropdown` layout, preserving the dynamic datasets for modal opening.

**Tech Stack:** PHP, Laravel Blade, HTML/CSS (Bootstrap 5, FontAwesome)

## Global Constraints
- Replicate the exact markup style and CSS class usage from the client projects dropdown list view.
- Preserve all existing dataset attributes (`data-team-id`, `data-name`, etc.) and the JS handler trigger `onclick="openSalaryModal(this)"`.

---

### Task 1: Replace Actions Column in Payroll Index

**Files:**
- Modify: [index.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Payroll/resources/views/index.blade.php#L129-L158)

**Interfaces:**
- Consumes: Blade template variables `$team`, `$rec`, `$year`, `$month`.
- Produces: Updated table layout with a functioning Bootstrap 5 dropdown button and menu.

- [ ] **Step 1: Replace the table cell with the new dropdown markup**

Modify [index.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Payroll/resources/views/index.blade.php#L129-L158):

```html
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
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
                                                                    data-team-id="{{ $team->id }}"
                                                                    data-name="{{ $team->translate?->name }}"
                                                                    data-year="{{ $year }}"
                                                                    data-month="{{ $month }}"
                                                                    data-base="{{ $rec?->base_salary ?? 0 }}"
                                                                    data-bonus="{{ $rec?->bonus ?? 0 }}"
                                                                    data-deductions="{{ $rec?->deductions ?? 0 }}"
                                                                    data-notes="{{ $rec?->notes ?? '' }}"
                                                                    onclick="openSalaryModal(this)">
                                                                    <i class="fas fa-{{ $rec ? 'edit' : 'plus' }}"></i>
                                                                    {{ $rec ? __('Edit') : __('Set Salary') }}
                                                                </a>
                                                            </li>
                                                            @if($rec && $rec->status === 'pending')
                                                            <li>
                                                                <form method="POST"
                                                                      action="{{ route('admin.payroll.mark-paid', $rec->id) }}"
                                                                      onsubmit="return confirm('Mark this member as paid and send email?')">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fas fa-check"></i> {{ __('Mark Paid') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    @if($rec && $rec->status === 'paid')
                                                        <small class="text-muted">
                                                            {{ __('Paid') }} {{ $rec->paid_at?->format('d M Y') }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>
```

- [ ] **Step 2: Commit the changes**

Run command:
```powershell
git add Modules/Payroll/resources/views/index.blade.php docs/superpowers/specs/2026-06-26-payroll-dropdown-design.md docs/superpowers/plans/2026-06-26-payroll-dropdown.md
git commit -m "feat: replace inline action buttons with standard dropdown in payroll index"
```
