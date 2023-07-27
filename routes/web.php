<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes();

/* Route for Homepage */
Route::get('/', 'HomeController@index')->name('home');
Route::post('/inquiry', 'HomeController@postInquiry')->name('submit_inquiry');

/* Route for Resident's Interface with localization prefix (Homepage, Feedback Form & Request Form) */
Route::group(['prefix' => '{locale}', 'middleware' => 'setLocale'], function(){
    Route::get('/', 'HomeController@index')->name('locale_home');
    Route::get('/inquiry', 'HomeController@getInquiry')->name('inquiry');
});

Route::get('customer/register', 'Customer\AuthController@getRegister')->name('customer.register.get');
Route::post('customer/register', 'Customer\AuthController@postRegister')->name('customer.register.post');
Route::get('customer/verify-email/{token}', 'Customer\AuthController@getVerifyEmail')->name('customer.verify-email.get');
Route::put('customer/verify-email', 'Customer\AuthController@postVerifyEmail')->name('customer.verify-email.post');
Route::get('customer/login', 'Customer\AuthController@getLogin')->name('customer.login.get');
Route::post('customer/login', 'Customer\AuthController@postLogin')->name('customer.login.post')->middleware(['throttle:login_limit']);
Route::get('customer/reload-captcha', 'Customer\AuthController@reloadCaptcha')->name('customer.reload-captcha.get');
Route::get('customer/forgot-password', 'Customer\AuthController@getforgotPassword')->name('customer.forgot-password.get');
Route::post('customer/forgot-password', 'Customer\AuthController@postforgotPassword')->name('customer.forgot-password.post');
Route::get('customer/reset-password/{token}', 'Customer\AuthController@getResetPassword')->name('customer.reset-password.get');
Route::put('customer/reset-password', 'Customer\AuthController@postResetPassword')->name('customer.reset-password.post');
Route::get('customer/logout', 'Customer\AuthController@logout')->name('customer.logout');

/* Route for Customer */
Route::group(['prefix' => 'customer', 'middleware' => ['is_customer']], function(){
    
    // Customer Profile
    Route::post('/profile/update', 'Customer\ProfileController@updateProfile')->name('customer.profile.update');
    Route::post('/password/update', 'Customer\ProfileController@updatePassword')->name('customer.password.update');

    // Appointment
    Route::get('/appointments', 'Customer\AppointmentController@index')->name('customer.appointments.index');
    Route::post('/appointments/verify-timeslot', 'Customer\AppointmentController@verifyTimeslot')->name('customer.appointments.verifyTimeslot');
    Route::get('/appointments/pets', 'Customer\AppointmentController@getPets')->name('customer.appointments.getPets');
    Route::get('/appointments/services', 'Customer\AppointmentController@getServices')->name('customer.appointments.getServices');
    Route::post('appointments/store', 'Customer\AppointmentController@store')->name('customer.appointments.store');
    Route::post('appointments/update', 'Customer\AppointmentController@update')->name('customer.appointments.update');
    // Route::post('appointments/delete', 'Customer\AppointmentController@delete')->name('customer.appointments.delete');
    Route::post('appointments/{id}', 'Customer\AppointmentController@getId')->name('customer.appointments.getId');
    Route::post('appointments/reschedule/{id}', 'Customer\AppointmentController@reschedule')->name('customer.appointments.reschedule');
    Route::get('appointments/all', 'Customer\AppointmentController@getAllAppointments')->name('customer.appointments.all');

    // Pet History
    Route::get('/pets-history', 'Customer\PetHistoryController@index')->name('customer.pets-history.index');
    Route::get('/pets-history/{id}', 'Customer\PetHistoryController@getPetHistory')->name('customer.pets-history.getPetHistory');

    // Pet
    Route::get('/pets', 'Customer\PetController@index')->name('customer.pets.index');
    Route::post('pets/store', 'Customer\PetController@store')->name('customer.pets.store');
    Route::post('pets/update', 'Customer\PetController@update')->name('customer.pets.update');
    Route::post('pets/delete', 'Customer\PetController@delete')->name('customer.pets.delete');
    Route::post('pets/{id}', 'Customer\PetController@getId')->name('customer.pets.getId');
    Route::post('pets-breed', 'Customer\PetController@getBreedByType')->name('customer.pets.getBreedByType');

});

Route::get('admin/login', 'Admin\AuthController@getLogin')->name('admin.login.get');
Route::post('admin/login', 'Admin\AuthController@postLogin')->name('admin.login.post')->middleware(['throttle:login_limit']);
Route::get('admin/reload-captcha', 'Admin\AuthController@reloadCaptcha')->name('admin.reload-captcha.get');
Route::get('admin/forgot-password', 'Admin\AuthController@getforgotPassword')->name('admin.forgot-password.get');
Route::post('admin/forgot-password', 'Admin\AuthController@postforgotPassword')->name('admin.forgot-password.post');
Route::get('admin/reset-password/{token}', 'Admin\AuthController@getResetPassword')->name('admin.reset-password.get');
Route::put('admin/reset-password', 'Admin\AuthController@postResetPassword')->name('admin.reset-password.post');
Route::get('admin/logout', 'Admin\AuthController@logout')->name('admin.logout');

/* Route for Administrator */
Route::group(['prefix' => 'admin', 'middleware' => ['is_admin']], function(){
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.index');
    Route::get('/dashboard/view', 'Admin\DashboardController@view')->name('admin.view');
    Route::get('/dashboard/weekly-appointment', 'Admin\DashboardController@getWeeklyAppointment')->name('admin.weekly-appointment');

    // Appointment
    Route::get('/appointments', 'Admin\AppointmentController@index')->name('admin.appointments.index');
    Route::get('/appointments/pets/{owner_id}', 'Admin\AppointmentController@getPets')->name('admin.appointments.getPets');
    Route::get('/appointments/services', 'Admin\AppointmentController@getServices')->name('admin.appointments.getServices');
    Route::post('appointments/update', 'Admin\AppointmentController@update')->name('admin.appointments.update');
    Route::post('appointments/{id}', 'Admin\AppointmentController@getId')->name('admin.appointments.getId');


    // Services
    Route::get('/services', 'Admin\ServiceController@index')->name('admin.services.index');
    Route::post('services/store', 'Admin\ServiceController@store')->name('admin.services.store');
    Route::post('services/update', 'Admin\ServiceController@update')->name('admin.services.update');
    Route::post('services/delete', 'Admin\ServiceController@delete')->name('admin.services.delete');
    Route::post('services/{id}', 'Admin\ServiceController@getId')->name('admin.services.getId');

    // Pet Types
    Route::get('/pet-types', 'Admin\PetTypeController@index')->name('admin.pet-type.index');
    Route::post('pet-types/store', 'Admin\PetTypeController@store')->name('admin.pet-type.store');
    Route::post('pet-types/update', 'Admin\PetTypeController@update')->name('admin.pet-type.update');
    Route::post('pet-types/delete', 'Admin\PetTypeController@delete')->name('admin.pet-type.delete');
    Route::post('pet-types/{id}', 'Admin\PetTypeController@getId')->name('admin.pet-type.getId');

    // Pet Breeds
    Route::get('/pet-breeds', 'Admin\PetBreedController@index')->name('admin.pet-breed.index');
    Route::post('/pet-breeds/types', 'Admin\PetBreedController@getPetTypes')->name('admin.pet-breed.types');
    Route::post('pet-breeds/store', 'Admin\PetBreedController@store')->name('admin.pet-breed.store');
    Route::post('pet-breeds/update', 'Admin\PetBreedController@update')->name('admin.pet-breed.update');
    Route::post('pet-breeds/delete', 'Admin\PetBreedController@delete')->name('admin.pet-breed.delete');
    Route::post('pet-breeds/{id}', 'Admin\PetBreedController@getId')->name('admin.pet-breed.getId');

    

    // Admin Profile
    Route::post('/profile/update', 'Admin\ProfileController@updateProfile')->name('admin.profile.update');
    Route::post('/password/update', 'Admin\ProfileController@updatePassword')->name('admin.password.update');

    // Inquiries
    Route::get('/inquiries/{filter}', 'Admin\InquiryController@index')->name('admin.inquiries.index');
    Route::get('/inquiries-export-excel/{filter}', 'Admin\InquiryController@exportExcel')->name('admin.inquiries.export-excel');
    Route::get('/inquiries-export-pdf/{filter}', 'Admin\InquiryController@exportPDF')->name('admin.inquiries.export-pdf');


    /** Settings **/

    // Clinic
    Route::get('/settings/clinic', 'Admin\Settings\ClinicController@index')->name('admin.settings.clinic.index');
    Route::post('/settings/clinic/update', 'Admin\Settings\ClinicController@update')->name('admin.settings.clinic.update');
    Route::post('/settings/clinic/{id}', 'Admin\Settings\ClinicController@getId')->name('admin.settings.clinic.getId');

    // Users
    Route::get('/settings/users', 'Admin\Settings\UserController@index')->name('admin.settings.users.index');
    Route::post('/settings/users/store', 'Admin\Settings\UserController@store')->name('admin.settings.users.store');
    Route::post('/settings/users/update', 'Admin\Settings\UserController@update')->name('admin.settings.users.update');
    Route::post('/settings/users/deleteUser', 'Admin\Settings\UserController@deleteUser')->name('admin.settings.users.deleteUser');
    Route::post('/settings/users/{id}', 'Admin\Settings\UserController@getUserById')->name('admin.settings.users.getUserById');

    // User Roles
    Route::get('/settings/user-roles', 'Admin\Settings\UserRoleController@index')->name('admin.settings.users-role.index');
    Route::post('/settings/user-roles/store', 'Admin\Settings\UserRoleController@store')->name('admin.settings.user-roles.store');
    Route::post('/settings/user-roles/update', 'Admin\Settings\UserRoleController@update')->name('admin.settings.user-roles.update');
    Route::post('/settings/user-roles/deleteUserRole', 'Admin\Settings\UserRoleController@deleteUserRole')->name('admin.settings.user-roles.deleteUserRole');
    Route::post('/settings/user-roles/{id}', 'Admin\Settings\UserRoleController@getUserRoleById')->name('admin.settings.user-roles.getUserRoleById');

    // Database Backup
    Route::get('/database-backup', 'Admin\DatabaseBackupController@download')->name('admin.database-backup.download');

    // Activity Logs
    Route::get('/settings/activity-logs/{module}/{log_type}/{date_from}/{date_to}', 'Admin\ActivityLogController@index')->name('admin.settings.activity-logs.index');
    Route::get('/settings/activity-logs-export-excel/{module}/{log_type}/{date_from}/{date_to}', 'Admin\ActivityLogController@exportExcel')->name('admin.settings.activity-logs.export-excel');
    Route::get('/settings/activity-logs-export-pdf/{module}/{log_type}/{date_from}/{date_to}', 'Admin\ActivityLogController@exportPDF')->name('admin.settings.activity-logs.export-pdf');
});
