<style>
/* Style for nested dropdown positioning */
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu > .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -0.5rem;
}

</style>
<div class="card mb-4 shadow-sm border-0">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
     
        <ul class="nav">
            {{-- Patients --}}
            @can('viewpatients')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="patientsDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-user-injured"></span>
                    <span class="mtext">Patients</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="patientsDropdown">
                    @can('viewpatients')
                    <li><a class="dropdown-item" href="{{ route('patients.index') }}">All Patients</a></li>
                    @endcan
                    @can('createpatients')
                    <li><a class="dropdown-item" href="{{ route('patients.create') }}">Register Patient</a></li>
                    @endcan
                    @can('viewpatientsummary')
                    <li><a class="dropdown-item" href="{{ route('patients.summary', ['patient' => 1]) }}">Patient Summary</a></li>
                    @endcan
                    @can('uploadpatientattachments')
                    <li><a class="dropdown-item" href="{{ route('patients.attachments.create') }}">Upload Attachment</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- Appointments --}}
            @can('viewappointments')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="appointmentsDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-calendar"></span>
                    <span class="mtext">Appointments</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="appointmentsDropdown">
                    @can('viewappointments')
                    <li><a class="dropdown-item" href="{{ route('appointments.index') }}">View Appointments</a></li>
                    @endcan
                    @can('createappointments')
                    <li><a class="dropdown-item" href="{{ route('appointments.create') }}">Book Appointment</a></li>
                    @endcan
                    @can('viewappointmentqueue')
                    <li><a class="dropdown-item" href="{{ route('appointments.queue') }}">Appointment Queue</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- Visits --}}
            @can('viewvisits')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="visitsDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-notes-medical"></span>
                    <span class="mtext">Visits</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="visitsDropdown">
                    @can('viewvisits')
                    <li><a class="dropdown-item" href="{{ route('visits.index') }}">All Visits</a></li>
                    @endcan
                    @can('createvisits')
                    <li><a class="dropdown-item" href="{{ route('visits.create') }}">New Visit</a></li>
                    @endcan
                    @can('viewvisitbilling')
                    <li><a class="dropdown-item" href="{{ route('visits.billing.create') }}">Visit Billing</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- Inpatient --}}
            @can('view_admissions')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="inpatientDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-procedures"></span>
                    <span class="mtext">Inpatient</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="inpatientDropdown">
                    @can('list_admissions')
                    <li><a class="dropdown-item" href="{{ route('admissions.index') }}">All Admissions</a></li>
                    @endcan
                    @can('add_admissions')
                    <li><a class="dropdown-item" href="{{ route('admissions.create') }}">New Admission</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- Outpatient --}}
            @can('view_outpatient')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="outpatientDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-user-md"></span>
                    <span class="mtext">Outpatient</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="outpatientDropdown">
                    @can('list_outpatients')
                    <li><a class="dropdown-item" href="{{ route('outpatients.index') }}">All Outpatient</a></li>
                    @endcan
                    @can('add_outpatient')
                    <li><a class="dropdown-item" href="{{ route('outpatients.create') }}">New Outpatient</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- Maternity --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="maternityDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-baby"></span>
                    <span class="mtext">Maternity</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="maternityDropdown">
                    <li><a class="dropdown-item" href="{{ route('cases.index') }}">All Maternity Cases</a></li>
                    <li><a class="dropdown-item" href="{{ route('cases.create') }}">New Maternity Case</a></li>
                </ul>
            </li>

            {{-- Immunization --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="immunizationDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-syringe"></span>
                    <span class="mtext">Immunization</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="immunizationDropdown">
                    <li><a class="dropdown-item" href="{{ url('patients') }}">Search Patient</a></li>
                </ul>
            </li>

            {{-- Laboratory --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="labDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-vial"></span>
                    <span class="mtext">Laboratory</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="labDropdown">
                    <li><a class="dropdown-item" href="{{ route('lab_orders.index') }}">Lab Orders</a></li>
                    <li><a class="dropdown-item" href="{{ route('lab_results.index') }}">Results</a></li>
                    <li><a class="dropdown-item" href="{{ route('lab-tests.index') }}">Lab Tests</a></li>
                </ul>
            </li>

            {{-- Operation Theatre --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="otDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-procedures"></span>
                    <span class="mtext">Operation Theatre</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="otDropdown">
                    <li><a class="dropdown-item" href="{{ route('surgery.requests') }}">Surgery Requests</a></li>
                    <li><a class="dropdown-item" href="{{ route('surgery.schedule') }}">Schedule Surgery</a></li>
                    <li><a class="dropdown-item" href="{{ route('surgery.perform') }}">Perform Surgery</a></li>
                    <li><a class="dropdown-item" href="#">Surgery Reports</a></li>
                    <li><a class="dropdown-item" href="#">Print Reports</a></li>
                </ul>
            </li>
             {{-- Imaging --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="imagingDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-x-ray"></span>
                    <span class="mtext">Imaging</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="imagingDropdown">
                    <li><a class="dropdown-item" href="{{ route('orders.index') }}">Imaging Orders</a></li>
                    <li><a class="dropdown-item" href="{{ route('radiology.results.index') }}">Print Reports</a></li>
                </ul>
            </li>

            {{-- EMR --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="emrDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-x-ray"></span>
                    <span class="mtext">EMR</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="emrDropdown">
                    <li><a class="dropdown-item" href="">ClinicEMR</a></li>
                </ul>
            </li>

            {{-- Billing --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="billingDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-file-invoice-dollar"></span>
                    <span class="mtext">Billing</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="billingDropdown">
                    <li><a class="dropdown-item" href="{{ route('billing.invoices') }}">Invoices</a></li>
                    <li><a class="dropdown-item" href="{{ route('billing.payments.index') }}">Payments</a></li>
                    <li><a class="dropdown-item" href="#">Refunds</a></li>
                    <li><a class="dropdown-item" href="{{ route('billing.visit-orders', ['visit' => 1]) }}">View Orders</a></li>
                </ul>
            </li>

            {{-- Accounts --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="accountsDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-wallet"></span>
                    <span class="mtext">Accounts</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountsDropdown">
                    <li><a class="dropdown-item" href="{{ route('transactions.create') }}">Add Transaction</a></li>
                    <li><a class="dropdown-item" href="{{ route('transactions.index') }}">All Transactions</a></li>
                    <li><a class="dropdown-item" href="{{ route('ledgers.index') }}">Ledgers</a></li>
                    <li><a class="dropdown-item" href="{{ route('trialbalance.index') }}">Trial Balance</a></li>
                    <li><a class="dropdown-item" href="{{ route('profitloss.index') }}">Profit &amp; Loss</a></li>
                    <li><a class="dropdown-item" href="{{ route('accounts.index') }}">Chart of Accounts</a></li>
                </ul>
            </li>

            {{-- Pharmacy --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="pharmacyDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-pills"></span>
                    <span class="mtext">Pharmacy</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="pharmacyDropdown">
                    <li><a class="dropdown-item" href="{{ route('pharmacy.dashboard') }}">Dashboard</a></li>
                    <li><a class="dropdown-item" href="{{ route('sales.index') }}">Sales</a></li>
                    <li><a class="dropdown-item" href="{{ route('dispense.index') }}">Dispense</a></li>
                    <li><a class="dropdown-item" href="{{ route('stock.index') }}">Stock Overview</a></li>
                    <li><a class="dropdown-item" href="{{ route('stock.receive') }}">Receive Stock</a></li>
                    <li><a class="dropdown-item" href="{{ route('pharmacy.alerts') }}">Alerts</a></li>
                </ul>
            </li>

            {{-- Inventory --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="inventoryDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-boxes"></span>
                    <span class="mtext">Inventory</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="inventoryDropdown">
                    <li><a class="dropdown-item" href="{{ route('inventory.dashboard') }}">Dashboard</a></li>
                    <li><a class="dropdown-item" href="{{ route('items.index') }}">Items</a></li>
                    <li><a class="dropdown-item" href="{{ route('requisitions.index') }}">Requisitions</a></li>
                    <li><a class="dropdown-item" href="{{ route('stores.index') }}">Stores</a></li>
                    <li><a class="dropdown-item" href="{{ route('transfers.index') }}">Stock Transfers</a></li>
                    <li><a class="dropdown-item" href="{{ route('purchase-orders.index') }}">Purchase Orders</a></li>
                    <li><a class="dropdown-item" href="{{ route('grns.index') }}">Goods Received Notes</a></li>
                    <li><a class="dropdown-item" href="{{ route('adjustments.index') }}">Stock Adjustments</a></li>
                </ul>
            </li>

            {{-- Human Resource --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="hrDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-users"></span>
                    <span class="mtext">Human Resource</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="hrDropdown">
                    <li><a class="dropdown-item" href="{{ route('employees.index') }}">Employees</a></li>
                    <li><a class="dropdown-item" href="{{ route('leaves.index') }}">Leave Requests</a></li>
                    <li><a class="dropdown-item" href="{{ route('rosters.index') }}">Roster</a></li>
                    <li><a class="dropdown-item" href="{{ route('payrolls.index') }}">Payroll</a></li>
                    <li><a class="dropdown-item" href="{{ route('payslips.index') }}">Payslips</a></li>
                    <li><a class="dropdown-item" href="{{ route('deductions.index') }}">Deductions</a></li>
                </ul>
            </li>

            <!-- Reports -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="micon fas fa-chart-line"></span>
                    <span class="mtext">Reports</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="reportsDropdown">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Financial Reports</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Daily Revenue Report</a></li>
                            <li><a class="dropdown-item" href="#">Outstanding Payments</a></li>
                            <li><a class="dropdown-item" href="#">Income Statement</a></li>
                            <li><a class="dropdown-item" href="#">Balance Sheet</a></li>
                            <li><a class="dropdown-item" href="#">Ledger Report</a></li>
                            <li><a class="dropdown-item" href="#">Cash Flow</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Clinical Reports</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Patient Visit Summary</a></li>
                            <li><a class="dropdown-item" href="#">OPD/IP Statistics</a></li>
                            <li><a class="dropdown-item" href="#">Consultation Reports</a></li>
                            <li><a class="dropdown-item" href="#">Lab Test Reports</a></li>
                            <li><a class="dropdown-item" href="#">Imaging Reports</a></li>
                            <li><a class="dropdown-item" href="#">Surgery/OT Reports</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Pharmacy Reports</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pharmacy Sales</a></li>
                            <li><a class="dropdown-item" href="#">Prescription Fulfillment</a></li>
                            <li><a class="dropdown-item" href="#">Drug Expiry Report</a></li>
                            <li><a class="dropdown-item" href="#">Pharmacy Stock Report</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Inventory Reports</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Stock On Hand</a></li>
                            <li><a class="dropdown-item" href="#">Movement Logs</a></li>
                            <li><a class="dropdown-item" href="#">Reorder Alerts</a></li>
                            <li><a class="dropdown-item" href="#">Stock Adjustments</a></li>
                            <li><a class="dropdown-item" href="#">Goods Received Notes</a></li>
                            <li><a class="dropdown-item" href="#">Purchase History</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">HR Reports</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Employee Directory</a></li>
                            <li><a class="dropdown-item" href="#">Leave Summary</a></li>
                            <li><a class="dropdown-item" href="#">Attendance Report</a></li>
                            <li><a class="dropdown-item" href="#">Payroll Report</a></li>
                            <li><a class="dropdown-item" href="#">Payslip History</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!-- Administration -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="mtext">Administration</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">System Administration</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">Users</a></li>
                            <li><a class="dropdown-item" href="{{ route('roles_permissions.index') }}">RolePermissions</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"> System Configuration</a></li>
                            <li><a class="dropdown-item" href="{{ route('audit.logs') }}">Audit Logs</a></li>
                            <li><a class="dropdown-item" href="{{ route('backups.index') }}">Backup & Restore</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Patient Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Patient Categories</a></li>
                            <li><a class="dropdown-item" href="#">Referral Sources</a></li>
                            <li><a class="dropdown-item" href="#">Nationalities</a></li>
                            <li><a class="dropdown-item" href="{{ route('counties.index') }}">counties</a></li>
                            <li><a class="dropdown-item" href="{{ route('subcounties.index') }}">subcounties</a></li>
                            <li><a class="dropdown-item" href="{{ route('sub_county_wards.index') }}">wards</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Visit Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Visit Types</a></li>
                            <li><a class="dropdown-item" href="#">Service Categories</a></li>
                            <li><a class="dropdown-item" href="#">Service Items</a></li>
                            <li><a class="dropdown-item" href="#">Consultation Templates</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Clinical Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('icd11.index') }}">ICD11</a></li>
                            <li><a class="dropdown-item" href="{{ route('clinical-diagnoses.index') }}">Diagnosis</a></li>
                            <li><a class="dropdown-item" href="{{ route('systematic-examinations.index') }}">Systematic Examinations</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Inpatient Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('wards.index') }}">Wards</a></li>
                            <li><a class="dropdown-item" href="{{ route('beds.index') }}">Beds</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Theatre Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Procedure Types</a></li>
                            <li><a class="dropdown-item" href="#">Operation Theatre Rooms</a></li>
                            <li><a class="dropdown-item" href="#">Surgical Teams</a></li>
                            <li><a class="dropdown-item" href="#">Pre/Post-Op Checklists</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Laboratory Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Lab Test Types</a></li>
                            <li><a class="dropdown-item" href="#">Lab Test Groups</a></li>
                            <li><a class="dropdown-item" href="#">Units of Measurement</a></li>
                            <li><a class="dropdown-item" href="#">Reference Ranges</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Imaging Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Imaging Types</a></li>
                            <li><a class="dropdown-item" href="#">Imaging Categories</a></li>
                            <li><a class="dropdown-item" href="#">Templates</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">HR Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('departments.index') }}">Departments</a></li>
                            <li><a class="dropdown-item" href="{{ route('designations.index') }}">Designations</a></li>
                            <li><a class="dropdown-item" href="{{ route('leave-types.index') }}">Leave Types</a></li>
                            <li><a class="dropdown-item" href="{{ route('payroll-deductions.index') }}">Payroll Deductions</a></li>
                            <li><a class="dropdown-item" href="{{ route('allowances.index') }}">Allowances</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Inventory Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="">Item Categories</a></li>
                            <li><a class="dropdown-item" href="#">Measurement Units</a></li>
                            <li><a class="dropdown-item" href="#">Vendors</a></li>
                            <li><a class="dropdown-item" href="#">Store Locations</a></li>
                            <li><a class="dropdown-item" href="#">Reorder Levels</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Pharmacy Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Drug Categories</a></li>
                            <li><a class="dropdown-item" href="#">Dosage Forms</a></li>
                            <li><a class="dropdown-item" href="#">Administration Routes</a></li>
                            <li><a class="dropdown-item" href="#">Pharmacy Locations</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Accounts Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Chart of Accounts</a></li>
                            <li><a class="dropdown-item" href="#">Payment Methods</a></li>
                            <li><a class="dropdown-item" href="#">Tax Setup</a></li>
                            <li><a class="dropdown-item" href="#">Fiscal Year</a></li>
                            <li><a class="dropdown-item" href="{{ route('insurances.index') }}">Insurance</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <div class="card-body">
        {{-- Optional: include help, tips, or search filters --}}
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Enable hover or click toggle for submenu
        document.querySelectorAll('.dropdown-submenu .dropdown-toggle').forEach(function (dropdown) {
            dropdown.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const submenu = this.nextElementSibling;

                // Close other open submenus at the same level
                const parentMenu = this.closest('.dropdown-menu');
                parentMenu.querySelectorAll('.dropdown-menu').forEach(function (menu) {
                    if (menu !== submenu) {
                        menu.classList.remove('show');
                    }
                });

                // Toggle current submenu
                submenu.classList.toggle('show');
            });
        });

        // Close all submenus when parent dropdown closes
        document.querySelectorAll('.dropdown').forEach(function (dropdown) {
            dropdown.addEventListener('hidden.bs.dropdown', function () {
                this.querySelectorAll('.dropdown-menu.show').forEach(function (submenu) {
                    submenu.classList.remove('show');
                });
            });
        });
    });
</script>

