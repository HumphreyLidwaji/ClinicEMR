<?php
use App\Http\Controllers\Settings;
use App\Http\Controllers\ProcedureOrderController;
use App\Http\Controllers\Laboratory\LabController;
use App\Http\Controllers\Radiology\ImagingController;
use App\Http\Controllers\Billing\BillingController;
use App\Http\Controllers\Visits\VisitController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Icd11\Icd11Controller;
use App\Http\Controllers\Vital\VitalController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\RadiologyOrderController;
use App\Http\Controllers\Department\DepartmentController;  
use App\Http\Controllers\RadiologyServiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\PatientAttachmentController;
use App\Http\Controllers\LabOrderController;
use App\Http\Controllers\Drug\DrugController;
use App\Http\Controllers\Billing\PaymentController;
use App\Http\Controllers\Billing\InvoiceController;
use App\Http\Controllers\Laboratory\LabRequestController;
use App\Http\Controllers\Laboratory\LabTestController;
use App\Http\Controllers\Laboratory\LabResultController;
use App\Http\Controllers\Laboratory\LabResultTemplateController;
use App\Http\Controllers\Dosage\DosageController;
use App\Http\Controllers\Route\RouteController;
use App\Http\Controllers\Medication\MedicationController;
use App\Http\Controllers\Billing\InvoiceItemController;
use App\Http\Controllers\Laboratory\SampleCollectionController;
use App\Http\Controllers\Consultation\ConsultationController;
use App\Http\Controllers\Vendors\VendorController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Inpatient\AdmissionController;
use App\Http\Controllers\Inpatient\WardController;
use App\Http\Controllers\Inpatient\BedController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\TrialBalanceController;
use App\Http\Controllers\ProfitLossController;
use App\Http\Controllers\AccountMappingController;
use App\Http\Controllers\RadiologyResultController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\DischargeSummaryController;
use App\Http\Controllers\Maternity\MaternityCaseController;
use App\Http\Controllers\Maternity\ANCVisitController;
use App\Http\Controllers\Maternity\DeliveryController;
use App\Http\Controllers\Maternity\BabyController;
use App\Http\Controllers\ImmunizationController;
use App\Http\Controllers\DispenseController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SystemAdministration\DatabaseBackupController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\SubcountyController;
use App\Http\Controllers\SubCountyWardController;
use App\Http\Controllers\SystematicExaminationController;
use App\Http\Controllers\ClinicalDiagnosisController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SystemAdministration\RolePermissionController;
use App\Http\Controllers\Admin\ClinicSettingsController;
use App\Http\Controllers\InventoryDashboardController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\ItemTransferController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\GoodsReceivedNoteController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
});

require __DIR__.'/auth.php';
//users
Route::resource('users', \App\Http\Controllers\UserController::class);
Route::prefix('users')->middleware('auth')->group(function () {
    Route::get('{user}/security', [UserController::class, 'security'])->name('users.security');
    Route::post('{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
    Route::post('{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggleBlock');
});

//employee
Route::resource('employees', EmployeeController::class);
Route::resource('leaves', LeavesController::class);
Route::post('leaves/{leave}/approve', [LeavesController::class, 'approve'])->name('leaves.approve');
Route::post('leaves/{leave}/reject', [LeavesController::class, 'reject'])->name('leaves.reject');
Route::get('/leave-balance', function (Request $request) {
    $balance = \App\Models\LeaveBalance::where('employee_id', $request->employee_id)
        ->where('leave_type', $request->type)->first();

    return response()->json(['remaining' => $balance?->remaining_days ?? 0]);
});
Route::resource('payrolls', PayrollController::class);
Route::resource('payslips', PayslipController::class);
Route::get('payslips/{payslip}/download', [PayslipController::class, 'download'])->name('payslips.download');
Route::resource('deductions', DeductionController::class);
Route::resource('rosters', RosterController::class);
Route::post('/rosters/bulk-assign', [RosterController::class, 'bulkAssign'])->name('rosters.bulkAssign');
Route::get('/rosters/print/department', [RosterController::class, 'printByDepartment'])->name('rosters.print.department');
Route::get('/rosters/print/individual', [RosterController::class, 'printIndividual'])->name('rosters.print.individual');


//county
Route::resource('counties', CountyController::class);
Route::resource('subcounties', SubcountyController::class);
Route::resource('sub_county_wards', SubCountyWardController::class);

//patient
Route::prefix('patients')->group(function () {
    Route::get('/', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');    
    Route::put('/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    Route::get('/{patient}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/summary/{patient}', [PatientController::class, 'summary'])->name('patients.summary');
});
Route::get('/get-subcounties/{county}', function ($countyId) {
    return \App\Models\Subcounty::where('county_id', $countyId)->get();
});

Route::get('/get-wards/{subcounty}', function ($subcountyId) {
    return \App\Models\SubCountyWard::where('subcounty_id', $subcountyId)->get();
});

//insurance
Route::resource('insurances', \App\Http\Controllers\InsuranceController::class)->middleware('auth');



Route::get('patients/attachments/create', [PatientAttachmentController::class, 'create'])->name('patients.attachments.create');
Route::post('patients/attachments', [PatientAttachmentController::class, 'store'])->name('patients.attachments.store');
//appointment
Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::get('appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::put('appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

Route::put('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
Route::post('appointments/{id}/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');
Route::post('appointments/{id}/start', [AppointmentController::class, 'start'])->name('appointments.start');
Route::get('appointments/queue', [AppointmentController::class, 'queue'])->name('appointments.queue');

//emr
Route::prefix('emr')->middleware(['auth'])->group(function () {
    Route::get('/patient/{id}', [\App\Http\Controllers\EMRController::class, 'index'])->name('emr.patient');
    Route::get('/visit/{id}', [\App\Http\Controllers\EMRController::class, 'showVisit'])->name('emr.visit');
    Route::get('/visit/{id}/print', [\App\Http\Controllers\EMRController::class, 'printVisit'])->name('emr.visit.print');
});

//visit
Route::resource('visits', VisitController::class);

Route::get('visits/vitals', [VisitController::class, 'vitals'])->name('visits.vitals');
Route::post('visits/vitals', [VisitController::class, 'saveVitals'])->name('visits.vitals.store');

Route::get('visits/medications', [VisitController::class, 'medications'])->name('visits.medications');
Route::post('visits/medications', [VisitController::class, 'saveMedications'])->name('visits.medications.store');

Route::get('visits/billing', [VisitController::class, 'billing'])->name('visits.billing');
Route::post('visits/billing', [VisitController::class, 'saveBilling'])->name('visits.billing.store');
//inpatient
Route::prefix('inpatient')->group(function () {
    Route::get('admissions', [AdmissionController::class, 'index'])->name('admissions.index');
    Route::get('admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
    Route::post('admissions', [AdmissionController::class, 'store'])->name('admissions.store');
Route::post('admissions/{id}/approve', [AdmissionController::class, 'approve'])->name('admissions.approve');
Route::get('admissions/{id}/assign-bed', [AdmissionController::class, 'showAssignBed'])->name('admissions.showAssignBed');
Route::post('admissions/{id}/assign-bed', [AdmissionController::class, 'assignBed'])->name('admissions.assignBed');

});
use App\Http\Controllers\InpatientController;

Route::prefix('inpatient')->name('inpatient.')->group(function () {
    Route::post('/consultation', [InpatientController::class, 'storeConsultation'])->name('consultation.store');
    Route::post('/progress', [InpatientController::class, 'storeProgress'])->name('progress.store');
    Route::post('/nursing', [InpatientController::class, 'storeNursing'])->name('nursing.store');
});


Route::get('inpatient/admissions/{id}/transfer', [AdmissionController::class, 'showTransfer'])->name('admissions.showTransfer');
Route::post('inpatient/admissions/{id}/transfer', [AdmissionController::class, 'transfer'])->name('admissions.transfer');
Route::get('admissions/{id}', [AdmissionController::class, 'show'])->name('admissions.show');


Route::prefix('inpatient')->group(function () {
    // ...other routes...
    Route::get('wards/{ward}/available-beds', [WardController::class, 'availableBeds']);
});
Route::prefix('inpatient')->group(function () {
    Route::get('wards', [WardController::class, 'index'])->name('wards.index');
    Route::get('wards/create', [WardController::class, 'create'])->name('wards.create');
    Route::post('wards', [WardController::class, 'store'])->name('wards.store');

    Route::get('beds', [BedController::class, 'index'])->name('beds.index');
    Route::get('beds/create', [BedController::class, 'create'])->name('beds.create');
    Route::post('beds', [BedController::class, 'store'])->name('beds.store');
});
Route::get('/inpatient-consultation/create/{admission_id}', [ConsultationController::class, 'createForAdmission'])->name('inpatient.consultation.create');


//vitals
Route::get('visits/vitals/create', [VitalController::class, 'create'])->name('visits.vitals.create');
Route::post('visits/vitals', [VitalController::class, 'store'])->name('visits.vitals.store');
// Consultation routes (linked to visits)
Route::post('/consultation/note/store', [ConsultationController::class, 'storeNote'])->name('consultation.note.store');
Route::post('/consultation/history/store', [ConsultationController::class, 'storeHistory'])->name('consultation.history.store');
Route::post('/consultation/systematic/store', [ConsultationController::class, 'storeSystematic'])->name('consultation.systematic.store');
Route::post('/consultation/diagnosis/store', [ConsultationController::class, 'storeDiagnosis'])->name('consultation.diagnosis.store');
Route::post('/consultation/icd11/store', [ConsultationController::class, 'storeICD11'])->name('consultation.icd11.store');
Route::post('/consultation/plan/store', [ConsultationController::class, 'storePlan'])->name('consultation.plan.store');

Route::prefix('consultation')->middleware(['auth'])->group(function () {
    Route::get('/', [ConsultationController::class, 'index'])->name('consultation.index');
    Route::get('/create', [ConsultationController::class, 'create'])->name('consultation.create');
  
    Route::get('/{id}/edit', [ConsultationController::class, 'edit'])->name('consultation.edit');
    Route::put('/{id}', [ConsultationController::class, 'update'])->name('consultation.update');
    Route::delete('/{id}', [ConsultationController::class, 'destroy'])->name('consultation.destroy');

});


Route::get('visits/consultation/note/create', [ConsultationController::class, 'createNote'])->name('consultation.notes.create');

//medication
Route::get('visits/medications/create', [MedicationController::class, 'create'])->name('visits.medications.create');
Route::post('visits/medications', [MedicationController::class, 'store'])->name('visits.medications.store');



//lab
Route::resource('laboratory/lab-tests', LabTestController::class);
Route::resource('laboratory/lab_orders', LabOrderController::class);
Route::get('laboratory/sample_collections', [SampleCollectionController::class, 'index'])->name('sample_collections.index');
Route::get('laboratory/sample_collections/create/{order}', [SampleCollectionController::class, 'create'])->name('sample_collections.create');
Route::post('laboratory/sample_collections', [SampleCollectionController::class, 'store'])->name('sample_collections.store');
Route::prefix('laboratory')->group(function () {
    Route::get('lab_results/create/{order}', [LabResultController::class, 'create'])->name('lab_results.create');
    Route::post('lab_results', [LabResultController::class, 'store'])->name('lab_results.store');
});
Route::prefix('laboratory')->name('laboratory.')->group(function () {
    Route::resource('templates', LabResultTemplateController::class);
});

// Index: View all lab results
Route::get('/laboratory/lab-results', [LabResultController::class, 'index'])->name('lab_results.index');

// Edit: Edit a specific lab result
Route::get('/laboratory/lab-results/{id}/edit', [LabResultController::class, 'edit'])->name('lab_results.edit');

// Already existing export route:
Route::get('/laboratory/lab-results/{id}/pdf', [LabResultController::class, 'exportPdf'])
    ->name('lab_results.pdf');
Route::get('/laboratory/lab-results/{id}', [LabResultController::class, 'show'])->name('lab_results.show');

//discharge

Route::prefix('discharge')->group(function () {
    Route::get('/', [DischargeSummaryController::class, 'index'])->name('discharge.index');
    Route::post('/store', [DischargeSummaryController::class, 'store'])->name('discharge.store');
    Route::get('/{id}', [DischargeSummaryController::class, 'show'])->name('discharge.show');
    Route::get('/{id}/pdf', [DischargeSummaryController::class, 'exportPdf'])->name('discharge.pdf');
    Route::get('/discharges/{id}/edit', [DischargeSummaryController::class, 'edit'])->name('discharges.edit');
Route::put('/discharges/{id}', [DischargeSummaryController::class, 'update'])->name('discharges.update');


});

//pharmacy
Route::prefix('pharmacy')->middleware(['auth'])->group(function () {
    Route::get('/', [PharmacyController::class, 'dashboard'])->name('pharmacy.dashboard');

    Route::resource('dispense', DispenseController::class)->only(['index', 'store']);
    Route::resource('sales', SalesController::class);
    Route::resource('drugs', DrugController::class);
    Route::resource('stock', StockController::class)->only(['index', 'create', 'store']);
    Route::resource('purchases', PurchaseOrderController::class);
    Route::resource('suppliers', SupplierController::class);

    Route::get('reports/sales', [ReportController::class, 'sales'])->name('pharmacy.reports.sales');
    Route::get('reports/stock', [ReportController::class, 'stock'])->name('pharmacy.reports.stock');
    Route::get('reports/expiry', [ReportController::class, 'expiry'])->name('pharmacy.reports.expiry');
    Route::get('/pharmacy/stock/receive', [StockController::class, 'receive'])->name('stock.receive');
Route::post('/pharmacy/stock/receive', [StockController::class, 'receiveStore'])->name('stock.receive.store');
Route::get('/pharmacy/alerts', [AlertController::class, 'pharmacyAlerts'])->name('pharmacy.alerts');
Route::get('/pharmacy/dispense/{visit}', [DispenseController::class, 'show'])->name('dispense.show');

});




//radiology
Route::resource('radiology/orders', RadiologyOrderController::class);
Route::get('radiology/results/create/{orderId}', [RadiologyResultController::class, 'create'])->name('radiology.results.create');
Route::post('/radiology/results', [RadiologyResultController::class, 'store'])->name('radiology.results.store');
Route::get('/radiology/results', [RadiologyResultController::class, 'index'])->name('radiology.results.index');
Route::get('/radiology/results/{id}', [RadiologyResultController::class, 'show'])->name('radiology.results.show');


                    
Route::resource('radiology', RadiologyServiceController::class);
Route::resource('services', ServiceController::class);
Route::resource('procedures', ProcedureController::class);
//services<?php


Route::resource('services', ServiceController::class);

//icd11
Route::get('icd11', [Icd11Controller::class, 'index'])->name('icd11.index');
Route::get('icd11/import', [Icd11Controller::class, 'importForm'])->name('icd11.import.form');
Route::post('icd11/import', [Icd11Controller::class, 'import'])->name('icd11.import');



//drugs
Route::resource('drugs', DrugController::class);
//dosages
Route::resource('dosages', DosageController::class);
//routes
Route::resource('routes', RouteController::class);
//billing
Route::get('visits/billing/create', [BillingController::class, 'create'])->name('visits.billing.create');
Route::post('visits/billing', [BillingController::class, 'store'])->name('visits.billing.store');
Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');

Route::get('billing/visit-orders/{visit}', [BillingController::class, 'showVisitOrders'])->name('billing.visit-orders');
Route::post('billing/visit-orders/{visit}/bill', [BillingController::class, 'billSelectedOrders'])->name('billing.visit-orders.bill');
Route::prefix('billing')->name('billing.')->middleware(['auth'])->group(function () {
    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');
});
Route::get('/visits/{visit}/bill-orders', [BillingController::class, 'showVisitOrders'])->name('billing.visit-orders.show');
Route::get('/orders/{type}/items', [OrderController::class, 'getItems']);
Route::put('/orders/{type}/{id}/update-item', [OrderController::class, 'updateItem'])->name('orders.updateItem');
Route::post('/orders/{type}/add', [OrderController::class, 'storeItem'])->name('orders.storeItem');

//clinic settings
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [ClinicSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [ClinicSettingsController::class, 'update'])->name('settings.update');
});


//lab-orders
Route::post('lab-orders', [LabOrderController::class, 'store'])->name('lab-orders.store');
//radiology-orders
Route::post('radiology-orders', [RadiologyOrderController::class, 'store'])->name('radiology-orders.store');
//services-order
Route::post('service-orders', [ServiceOrderController::class, 'store'])->name('service-orders.store');
//procedure order
Route::post('procedure-orders', [ProcedureOrderController::class, 'store'])->name('procedure-orders.store');



//payments
Route::prefix('billing')->middleware(['auth'])->name('billing.')->group(function () {
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/create/{invoice?}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('payments/store', [PaymentController::class, 'store'])->name('payments.store');
});





Route::prefix('billing')->name('billing.')->middleware(['auth'])->group(function () {
    Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices');
    Route::get('invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
});

//inventory
Route::get('/inventory/dashboard', [InventoryDashboardController::class, 'index'])->name('inventory.dashboard');
Route::resource('purchase-orders', PurchaseOrderController::class);
Route::resource('stores', StoreController::class);
Route::resource('items', ItemController::class);
Route::resource('adjustments', StockAdjustmentController::class)->only(['index', 'create', 'store']);
Route::resource('grns', GoodsReceivedNoteController::class)->except(['edit', 'update']);
Route::resource('transfers', ItemTransferController::class)->only(['index', 'create', 'store']);
Route::resource('requisitions', RequisitionController::class);
Route::post('requisitions/{requisition}/approve', [RequisitionController::class, 'approve'])->name('requisitions.approve');


//Vendor Management
Route::resource('vendors', VendorController::class);




//audit logs
Route::middleware(['auth', 'can:view-audit'])->group(function () {
    Route::get('/admin/audit-logs', [AuditLogController::class, 'index'])->name('audit.logs');
});
Route::get('/admin/audit-logs/export/excel', [AuditLogController::class, 'exportExcel'])->name('audit.logs.excel');
Route::get('/admin/audit-logs/export/pdf', [AuditLogController::class, 'exportPdf'])->name('audit.logs.pdf');



// Role and Permission Management


Route::prefix('system_administration/roles_permissions')->name('roles_permissions.')->group(function () {
    Route::get('/', [RolePermissionController::class, 'index'])->name('index');
    Route::post('/role', [RolePermissionController::class, 'storeRole'])->name('storeRole');
    Route::post('/permission', [RolePermissionController::class, 'storePermission'])->name('storePermission');
    Route::post('/assign-permission', [RolePermissionController::class, 'assignPermission'])->name('assignPermission');
    Route::post('/assign-role', [RolePermissionController::class, 'assignRole'])->name('assignRole');
});

//accounts
Route::resource('accounts', AccountController::class)->only(['index', 'create', 'store']);
Route::resource('transactions', TransactionController::class)->only(['index', 'create', 'store']);
Route::get('ledgers', [LedgerController::class, 'index'])->name('ledgers.index');
Route::get('trial-balance', [TrialBalanceController::class, 'index'])->name('trialbalance.index');
Route::get('profit-loss', [ProfitLossController::class, 'index'])->name('profitloss.index');

Route::resource('account-mappings', AccountMappingController::class)->only(['index', 'create', 'store']);



Route::prefix('admin')->group(function () {
    Route::get('/backups', [DatabaseBackupController::class, 'index'])->name('backups.index');
    Route::get('/backups/create', [DatabaseBackupController::class, 'createBackup'])->name('backups.create');
    Route::get('/backups/restore/{id}', [DatabaseBackupController::class, 'restoreBackup'])->name('backups.restore');
});


//Department
Route::resource('departments', DepartmentController::class);

Route::resource('designations', \App\Http\Controllers\HR\DesignationController::class);
Route::resource('leave-types', \App\Http\Controllers\HR\LeaveTypeController::class);
Route::resource('payroll-deductions', \App\Http\Controllers\HR\PayrollDeductionController::class);
Route::resource('allowances', \App\Http\Controllers\HR\AllowanceController::class);


//OT
Route::prefix('operation-theatre')->group(function () {
    Route::get('/requests', [SurgeryRequestController::class, 'index'])->name('surgery.requests');
    Route::get('/schedule', [SurgeryScheduleController::class, 'index'])->name('surgery.schedule');
    Route::post('/schedule/{id}', [SurgeryScheduleController::class, 'schedule'])->name('surgery.schedule.store');
    Route::get('/perform', [SurgeryPerformController::class, 'index'])->name('surgery.perform');
    Route::post('/perform/{id}', [SurgeryPerformController::class, 'store'])->name('surgery.perform.store');
    Route::get('/reports', [SurgeryReportController::class, 'index'])->name('surgery.reports');
    Route::get('/reports/print', [SurgeryReportController::class, 'print'])->name('surgery.reports.print');
});
use App\Http\Controllers\SurgeryRequestController;

Route::prefix('operation-theatre')->group(function () {
    Route::get('/requests', [SurgeryRequestController::class, 'index'])->name('surgery.requests');
    Route::get('/requests/create', [SurgeryRequestController::class, 'create'])->name('surgery.requests.create');
    Route::post('/requests', [SurgeryRequestController::class, 'store'])->name('surgery.requests.store');
    Route::get('/requests/{id}', [SurgeryRequestController::class, 'show'])->name('surgery.requests.show');
    Route::delete('/requests/{id}', [SurgeryRequestController::class, 'destroy'])->name('surgery.requests.destroy');
});
use App\Http\Controllers\SurgeryScheduleController;

Route::prefix('operation-theatre')->group(function () {
    Route::get('/schedule', [SurgeryScheduleController::class, 'index'])->name('surgery.schedule');
    Route::get('/schedule/{id}/edit', [SurgeryScheduleController::class, 'edit'])->name('surgery.schedule.edit');
    Route::post('/schedule/{id}', [SurgeryScheduleController::class, 'schedule'])->name('surgery.schedule.store');
});
use App\Http\Controllers\SurgeryPerformController;

// OT
Route::prefix('operation-theatre')->group(function () {
    Route::get('/perform', [SurgeryPerformController::class, 'index'])->name('surgery.perform');
    Route::post('/perform/{id}', [SurgeryPerformController::class, 'store'])->name('surgery.perform.store');
});
//outpatient
use App\Http\Controllers\OutpatientController;

Route::prefix('outpatients')->group(function () {
    Route::get('/', [OutpatientController::class, 'index'])->name('outpatients.index');
    Route::get('/create', [OutpatientController::class, 'create'])->name('outpatients.create');
    Route::post('/approve/{id}', [OutpatientController::class, 'approve'])->name('outpatients.approve');
    Route::get('/{id}', [OutpatientController::class, 'show'])->name('outpatients.show');
    Route::get('/{id}/edit', [OutpatientController::class, 'edit'])->name('outpatients.edit');
    Route::post('/store', [OutpatientController::class, 'store'])->name('outpatients.store');
Route::put('/{id}', [OutpatientController::class, 'update'])->name('outpatients.update');

});

//Maternity

// Maternity Cases (main entry)
Route::resource('maternity/cases', MaternityCaseController::class);

// Maternity print view (MoH 510 summary)
Route::get('maternity/cases/{case}/print', [MaternityCaseController::class, 'print'])->name('cases.print');

// ANC Visits nested under Case
Route::resource('maternity/cases.anc-visits', ANCVisitController::class)->shallow();

// Delivery nested under Case (assume one-to-one)
Route::get('maternity/cases/{case}/delivery/create', [DeliveryController::class, 'create'])->name('cases.deliveries.create');
Route::post('maternity/cases/{case}/delivery', [DeliveryController::class, 'store'])->name('cases.deliveries.store');

// Baby nested under Delivery
Route::resource('maternity/deliveries.babies', BabyController::class)->shallow();

//immunization


// View all immunizations for a patient
Route::get('patients/{patient}/immunizations', [ImmunizationController::class, 'index'])->name('immunizations.index');

// Update a specific record (mark given)
Route::put('immunizations/{record}', [ImmunizationController::class, 'update'])->name('immunizations.update');

// PDF / Print view
Route::get('patients/{patient}/immunizations/print', [ImmunizationController::class, 'print'])->name('immunizations.print');
// Edit
Route::get('babies/{baby}/edit', [BabyController::class, 'edit'])->name('babies.edit');
Route::put('babies/{baby}', [BabyController::class, 'update'])->name('babies.update');

// Print Birth Cert
Route::get('babies/{baby}/print', [BabyController::class, 'print'])->name('babies.print');

//CLINICALS
Route::resource('systematic-examinations', SystematicExaminationController::class)->middleware('auth');
Route::resource('clinical-diagnoses', ClinicalDiagnosisController::class)->middleware('auth');
