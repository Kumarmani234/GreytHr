<div class="mt-4">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="p-4 m-0 w-50 bg-white border rounded m-auto">
        <form wire:submit.prevent="grantLeavesForEmp">
            <p style="color: #778899;">Grant Leaves</p>
            <hr>
            <div class="form-group">
                <label for="emp_id" style="cursor: pointer;color: #778899;display:flex;align-items:center;gap:5px;">
                    <div wire:ignore class="icon-container" wire:click="openEmployeeIds" style="display: flex; justify-content: center; align-items: center;position:relative;">
                        <i class="fa-solid fa-plus" style="color: #778899;"></i>
                    </div>
                    <span style="font-size:12px;"> Add Employee</span>
                </label>
                @error('emp_ids') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Checkbox to select all employees -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAllEmployees" wire:model="selectAllEmployees" wire:click="toggleSelectAllEmployees">
                <label class="form-check-label" for="selectAllEmployees">
                    Select All Employees
                </label>
            </div>

            <!-- Employee IDs selection -->
            @if($showEmployees=='true')
                <div class="bg-white border rounded p-2 d-flex flex-column" style="width:30%;max-height: 150px;overflow-y:auto;font-size:12px;color:#778899;position:absolute;">
                    <div wire:click="closeEmployeeIds" style="display: flex;justify-content:end;cursor:pointer;font-weight:500;color:#778899;">X</div>
                    @foreach($employeeIds as $emp_id)
                        <label class="checkbox-container" style="display: flex;gap: 5px;align-items: center;">
                            <input type="checkbox" wire:model="selectedEmpIds" value="{{ $emp_id }}"> {{ $emp_id }}
                        </label>
                    @endforeach
                </div>
            @endif

            <!-- Rest of your form code -->
            <div class="form-group">
                <label for="leave_type" style="color: #778899;font-size:12px;">Leave Type</label>
                <select class="form-control placeholder-small" wire:model="leave_type">
                    <option value="">Select Leave Type</option>
                    <option value="Casual Leave Probation">Causal Leave Probation</option>
                    <option value="Maternity Leave">Maternity Leave</option>
                    <option value="Loss Of Pay">Loss Of Pay</option>
                    <option value="Sick Leave">Sick Leave</option>
                    <option value="Marriage Leave">Marriage Leave</option>
                    <option value="Casual Leave">Causal Leave</option>
                </select>
                @error('leave_type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="quota" style="color: #778899;font-size:12px;">Number of Leaves</label>
                <input type="number" class="form-control" wire:model="leave_balance">
                @error('leave_balance') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="from_date" style="color: #778899;font-size:12px;">From Date</label>
                <input type="date" class="form-control placeholder-small" wire:model="from_date">
                @error('from_date') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="to_date" style="color: #778899;font-size:12px;">To Date</label>
                <input type="date" class="form-control placeholder-small" wire:model="to_date">
                @error('to_date') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="d-flex align-items-center justify-content-center mt-2">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" style="background: rgb(2, 17, 79);border:none;font-size:12px;">Submit</button>
            </div>
        </form>
    </div>
</div>
