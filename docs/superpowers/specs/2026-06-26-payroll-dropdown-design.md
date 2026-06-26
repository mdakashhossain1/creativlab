# Payroll Actions Dropdown Design

Replace inline action buttons and form triggers in the Payroll Management table with a Bootstrap dropdown list, matching the design pattern from the Client Projects section.

## Proposed Changes

### [Payroll Module]

#### [MODIFY] [index.blade.php](file:///c:/xampp_8.2/htdocs/creativlab/landing-new/Modules/Payroll/resources/views/index.blade.php)
We will modify the "Action" column in the Payroll table.
Replace:
```html
<td>
    <button class="btn btn-sm btn-outline-primary me-1"
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
    </button>
    @if($rec && $rec->status === 'pending')
    <form method="POST"
          action="{{ route('admin.payroll.mark-paid', $rec->id) }}"
          style="display:inline;"
          onsubmit="return confirm('Mark this member as paid and send email?')">
        @csrf
        <button type="submit" class="btn btn-sm btn-success">
            <i class="fas fa-check me-1"></i>{{ __('Mark Paid') }}
        </button>
    </form>
    @elseif($rec && $rec->status === 'paid')
        <small class="text-muted ms-1">
            {{ __('Paid') }} {{ $rec->paid_at?->format('d M Y') }}
        </small>
    @endif
</td>
```
With:
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

## Verification Plan

### Manual Verification
- Navigate to `/admin/payroll` in a web browser.
- Verify that each row in the Payroll table has an **Action** dropdown button.
- Click the dropdown button and check options:
  - If salary not set: displays **Set Salary**.
  - If salary set but pending: displays **Edit** and **Mark Paid**.
  - If salary is paid: displays **Edit**.
- Confirm that clicking **Edit** / **Set Salary** successfully opens the `salaryModal`.
- Confirm that clicking **Mark Paid** prompts the confirmation box and submits successfully.
- Confirm that paid members display their payment date (`Paid DD MMM YYYY`) next to the dropdown menu button.
