{{-- filepath: resources/views/layouts/partials/sidebar.blade.php --}}
<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('vendors/images/deskapp-logo.svg') }}" alt="ClinicEMR Logo" class="dark-logo"
                onerror="this.onerror=null;this.src='vendors/images/deskapp-logo.svg';" />
            <img src="{{ asset('vendors/images/clinicemr-logo-white.svg') }}" alt="ClinicEMR Logo" class="light-logo"
                onerror="this.onerror=null;this.src='vendors/images/deskapp-logo.svg';" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <!-- Dashboard -->
                <li>
                    <a href="dash" class="dropdown-toggle no-arrow">
                        <span class="micon fas fa-house"></span>
                        <span class="mtext">Dashboard</span>
                    </a>
                </li>


                <!-- Patients -->
                @can('viewpatients')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-user-injured"></span>
                        <span class="mtext">Patients</span>
                    </a>
                    <ul class="submenu">
                        @can('viewpatients')
                        <li>
                            <a href="{{ route('patients.index') }}">All Patients</a>
                        </li>
                        @endcan
                        @can('createpatients')
                        <li>
                            <a href="{{ route('patients.create') }}">Register Patient</a>
                        </li>
                        @endcan
                        @can('viewpatientsummary')
                        <li>
                            <a href="{{ route('patients.summary', ['patient' => 1]) }}">Patient Summary</a>
                        </li>
                        @endcan
                        @can('uploadpatientattachments')
                        <li>
                            <a href="{{ route('patients.attachments.create') }}">Upload Patient Attachment</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- Appointments -->
                @can('viewappointments')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fas fa-calendarz"></span>
                        <span class="mtext">Appointments</span>
                    </a>
                    <ul class="submenu">
                        @can('viewappointments')
                        <li><a href="{{ route('appointments.index') }}">View Appointments</a></li>
                        @endcan
                        @can('createappointments')
                        <li><a href="{{ route('appointments.create') }}">Book Appointment</a></li>
                        @endcan
                        @can('viewappointmentqueue')
                        <li><a href="{{ route('appointments.queue') }}">Appointment Queue</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- Visits -->
                @can('viewvisits')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-notes-medical"></span>
                        <span class="mtext">Visits</span>
                    </a>
                    <ul class="submenu">
                        @can('viewvisits')
                        <li><a href="{{ route('visits.index') }}">All Visits</a></li>
                        @endcan
                        @can('createvisits')
                        <li><a href="{{ route('visits.create') }}">New Visit</a></li>
                        @endcan

                        @can('viewvisitbilling')
                        <li><a href="{{ route('visits.billing.create') }}">Visit Billing</a></li>
                        @endcan
                        <!--visit notes-->


                    </ul>
                </li>
                @endcan
                <!-- Inpatient -->
                @can('view_admissions')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-procedures"></span>
                        <span class="mtext">Inpatient</span>
                    </a>
                    <ul class="submenu">
                    @can('list_admissions')
                        <li><a href="{{ route('admissions.index') }}">All Admissions</a></li>
                    @endcan
                      @can('add_admissions')
                        <li><a href="{{ route('admissions.create') }}">New Admission</a></li>
                     @endcan
                    </ul>
                </li>
                 @endcan
                <!-- Outpatient -->
                 @can('view_outpatient')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-procedures"></span>
                        <span class="mtext">Outpatient </span>
                    </a>
                    <ul class="submenu">
                      @can('list_outpatients')
                        <li><a href="{{ route('outpatients.index') }}">All Outpatient</a></li>
                        @endcan
                         @can('add_outpatient')
                        <li><a href="{{ route('outpatients.create') }}">New Outpatient</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- Maternity -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-baby"></span>
                        <span class="mtext">Maternity</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('cases.index') }}">All Maternity Cases</a></li>
                        <li><a href="{{ route('cases.create') }}">New Maternity Case</a></li>
                    </ul>
                </li>

                <!-- Immunization -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-syringe"></span>
                        <span class="mtext">Immunization</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('patients') }}">Search Patient</a>
                        </li>
                    </ul>
                </li>
                <!-- Laboratory -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-vial"></span>
                        <span class="mtext">Laboratory</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('lab_orders.index') }}">Lab Orders</a></li>
                        <li><a href="{{ route('lab_results.index') }}">Results</a></li>
                        <li><a href="{{ route('lab-tests.index') }}">LabTest</a></li>
                    </ul>
                </li>
                <!-- Operation Theatre -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-procedures"></span>
                        <span class="mtext">Operation Theatre</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('surgery.requests') }}">Surgery Requests</a></li>
                        <li><a href="{{ route('surgery.schedule') }}">Schedule Surgery</a></li>
                        <li><a href="{{ route('surgery.perform') }}">Perform Surgery</a></li>
                        <li><a href="#">Surgery Reports</a></li>
                        <li><a href="#">Print Reports</a></li>
                    </ul>
                </li>
                <!-- Imaging -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-x-ray"></span>
                        <span class="mtext">Imaging</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('orders.index') }}">Imaging Orders</a></li>
                        <li><a href="{{ route('radiology.results.index') }}">Print Reports</a></li>
                    </ul>
                </li>
                <!-- EMR-->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-x-ray"></span>
                        <span class="mtext">EMR</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="">ClinicEMR</a></li>
                    </ul>
                </li>

                <!-- Billing -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-file-invoice-dollar"></span>
                        <span class="mtext">Billing</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('billing.invoices') }}">Invoices</a></li>
                        <li><a href="{{ route('billing.payments.index') }}">Payments</a></li>
                        <li><a href="#">Refunds</a></li>
                        <li><a href="{{ route('billing.visit-orders', ['visit' => 1]) }}">View Orders</a></li>
                        <!-- Example: visit id 1 -->
                    </ul>
                </li>

                <!-- Accounts -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-wallet"></span>
                        <span class="mtext">Accounts</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('transactions.create') }}">Add Transaction</a></li>
                        <li><a href="{{ route('transactions.index') }}">All Transactions</a></li>

                        <li><a href="{{ route('ledgers.index') }}">Ledgers</a></li>
                        <li><a href="{{ route('trialbalance.index') }}">Trial Balance</a></li>
                        <li><a href="{{ route('profitloss.index') }}">Profit &amp; Loss</a></li>
                        <li><a href="{{ route('accounts.index') }}">Chart of Accounts</a></li>
                    </ul>
                </li>
                <!-- Pharmacy -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-pills"></span>
                        <span class="mtext">Pharmacy</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('pharmacy.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('sales.index') }}">Sales</a></li>
                        <li><a href="{{ route('dispense.index') }}">Dispense</a></li>
                        <li><a href="{{ route('stock.index') }}">Stock Overview</a></li>
                        <li class="nav-item">
                            <a href="{{ route('stock.receive') }}" class="nav-link">
                                <i class="bi bi-box-arrow-in-down"></i> Receive Stock
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pharmacy.alerts') }}" class="nav-link">
                                <i class="bi bi-exclamation-circle"></i> Alerts
                            </a>
                        </li>


                    </ul>
                </li>
                <!-- Inventory -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-boxes"></span>
                        <span class="mtext">Inventory</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('inventory.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('items.index') }}">Items</a></li>
                        <li><a href="{{ route('requisitions.index') }}">Requisitions</a></li>
                        <li><a href="{{ route('stores.index') }}">Stores</a></li>
                        <li><a href="{{ route('transfers.index') }}">Stock Transfers</a></li>
                        <li><a href="{{ route('purchase-orders.index') }}">Purchase Orders</a></li>
                        <li><a href="{{ route('grns.index') }}">Goods Received Notes</a></li>
                        <li><a href="{{ route('adjustments.index') }}">Stock Adjustments</a></li>
                    </ul>
                </li>

                <!-- Human Resource -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-users"></span>
                        <span class="mtext">Human Resource</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('employees.index') }}">Employees</a></li>
                        <li><a href="{{ route('leaves.index') }}">Leave Requests</a></li>
                        <li><a href="{{ route('rosters.index') }}">Roster</a></li>
                        <li><a href="{{ route('payrolls.index') }}">Payroll</a></li>
                        <li><a href="{{ route('payslips.index') }}">Payslips</a></li>
                        <li><a href="{{ route('deductions.index') }}">Deductions</a></li>
                    </ul>
                </li>
                <!-- Reports -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-chart-line"></span>
                        <span class="mtext">Reports</span>
                    </a>
                    <ul class="submenu">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Financial Reports</a>
                            <ul class="submenu">
                                <li><a href="#">Daily Revenue Report</a></li>
                                <li><a href="#">Outstanding Payments</a></li>
                                <li><a href="#">Income Statement</a></li>
                                <li><a href="#">Balance Sheet</a></li>
                                <li><a href="#">Ledger Report</a></li>
                                <li><a href="#">Cash Flow</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Clinical Reports</a>
                            <ul class="submenu">
                                <li><a href="#">Patient Visit Summary</a></li>
                                <li><a href="#">OPD/IP Statistics</a></li>
                                <li><a href="#">Consultation Reports</a></li>
                                <li><a href="#">Lab Test Reports</a></li>
                                <li><a href="#">Imaging Reports</a></li>
                                <li><a href="#">Surgery/OT Reports</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Pharmacy Reports</a>
                            <ul class="submenu">
                                <li><a href="#">Pharmacy Sales</a></li>
                                <li><a href="#">Prescription Fulfillment</a></li>
                                <li><a href="#">Drug Expiry Report</a></li>
                                <li><a href="#">Pharmacy Stock Report</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Inventory Reports</a>
                            <ul class="submenu">
                                <li><a href="#">Stock On Hand</a></li>
                                <li><a href="#">Movement Logs</a></li>
                                <li><a href="#">Reorder Alerts</a></li>
                                <li><a href="#">Stock Adjustments</a></li>
                                <li><a href="#">Goods Received Notes</a></li>
                                <li><a href="#">Purchase History</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">HR Reports</a>
                            <ul class="submenu">
                                <li><a href="#">Employee Directory</a></li>
                                <li><a href="#">Leave Summary</a></li>
                                <li><a href="#">Attendance Report</a></li>
                                <li><a href="#">Payroll Report</a></li>
                                <li><a href="#">Payslip History</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- Settings & Administration -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fas fa-cog"></span>
                        <span class="mtext">Administration</span>
                    </a>
                    <ul class="submenu">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">System Administration</a>
                            <ul class="submenu">
                                <li><a href="{{ route('users.index') }}">Users</a></li>
                                <li><a href="{{ route('roles_permissions.index') }}">RolePermissions</a></li>
                                <li><a href="{{ route('admin.settings.index') }}"> System Configuration</a></li>

                                <li><a href="{{ route('audit.logs') }}">Audit Logs</a></li>
                                <li><a href="{{ route('backups.index') }}">Backup & Restore</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Patient Setup</a>
                            <ul class="submenu">
                                <li><a href="#">Patient Categories</a></li>
                                <li><a href="#">Referral Sources</a></li>
                                <li><a href="#">Nationalities</a></li>
                                <li><a href="{{ route('counties.index') }}">counties</a></li>
                                <li><a href="{{ route('subcounties.index') }}">subcounties</a></li>
                                <li><a href="{{ route('sub_county_wards.index') }}">wards</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Visit Setup</a>
                            <ul class="submenu">
                                <li><a href="#">Visit Types</a></li>
                                <li><a href="#">Service Categories</a></li>
                                <li><a href="#">Service Items</a></li>
                                <li><a href="#">Consultation Templates</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Clinical Setup</a>
                            <ul class="submenu">
                                <li><a href="{{ route('icd11.index') }}">ICD11</a></li>
                                <li><a href="{{ route('clinical-diagnoses.index') }}">Diagnosis</a></li>
                                <li><a href="{{ route('systematic-examinations.index') }}">Systematic Examinations</a>
                                </li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Inpatient Setup</a>
                            <ul class="submenu">
                                <li><a href="{{ route('wards.index') }}">Wards</a></li>

                                <li><a href="{{ route('beds.index') }}">Beds</a></li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Theatre Setup</a>
                            <ul class="submenu">
                                <li><a href="#">Procedure Types</a></li>
                                <li><a href="#">Operation Theatre Rooms</a></li>
                                <li><a href="#">Surgical Teams</a></li>
                                <li><a href="#">Pre/Post-Op Checklists</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Laboratory Setup</a>
                            <ul class="submenu">
                                <li><a href="#">Lab Test Types</a></li>
                                <li><a href="#">Lab Test Groups</a></li>
                                <li><a href="#">Units of Measurement</a></li>
                                <li><a href="#">Reference Ranges</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Imaging Setup</a>
                            <ul class="submenu">
                                <li><a href="#">Imaging Types</a></li>
                                <li><a href="#">Imaging Categories</a></li>
                                <li><a href="#">Templates</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">HR Setup</a>
                            <ul class="submenu">
                                <li><a href="{{ route('departments.index') }}">Departments</a></li>
                                <li><a href="{{ route('designations.index') }}">Designations</a></li>
                                <li><a href="{{ route('leave-types.index') }}">Leave Types</a></li>
                                <li><a href="{{ route('payroll-deductions.index') }}">Payroll Deductions</a></li>
                                <li><a href="{{ route('allowances.index') }}">Allowances</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Inventory Setup</a>
                            <ul class="submenu">
                                <li><a href="">Item Categories</a></li>
                                <li><a href="#">Measurement Units</a></li>
                                <li><a href="#">Vendors</a></li>
                                <li><a href="#">Store Locations</a></li>
                                <li><a href="#">Reorder Levels</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Pharmacy Setup</a>
                            <ul class="submenu">
                                <li><a href="#">Drug Categories</a></li>
                                <li><a href="#">Dosage Forms</a></li>
                                <li><a href="#">Administration Routes</a></li>
                                <li><a href="#">Pharmacy Locations</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">Accounts Setup</a>
                            <ul class="submenu">
                                <li><a href="#">Chart of Accounts</a></li>
                                <li><a href="#">Payment Methods</a></li>
                                <li><a href="#">Tax Setup</a></li>
                                <li><a href="#">Fiscal Year</a></li>
                                <li><a href="{{ route('insurances.index') }}">Insurance</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                
            </ul>
        </div>
    </div>
</div>
