<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register  routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**************
 * suad routs
 ************* */
 Auth::routes();
Route::group(['middleware' => ['auth','role:admin|sale_manager|sale_executive|accountant']], function() {
  Route::get('/logout','Auth\LoginController@logout');
  Route::get('/notify_count/{id}','NotificationController@counter_notify');
  Route::get('/user_notify/{id}','NotificationController@user_notify');
  Route::get('/status_notify/{s}/{from}/{to}/{status}', 'NotificationController@status_notify');
  Route::get('/user_profile/{id}', 'uuserController@user_profile');
  Route::get('/profile/{id}', 'uuserController@user_profile1_page');

});

 Route::group(['middleware' => ['auth','role:admin']], function() {
 Route::get('/','dashboard@index');
  /*****************AIRLINE************** */
Route::get('/airline_add', 'AirlineController@add');
Route::get('/is_active_airline/{id}', 'AirlineController@is_active');
Route::get('/no_active_airline/{id}', 'AirlineController@is_not_active');
Route::get('/airline_edit/{id}', 'AirlineController@display_row');
Route::get('/airline_display', 'AirlineController@display');
Route::get('/airline_delete/{id}', 'AirlineController@hide_row');
Route::post('/addairline','AirlineController@save1');
Route::post('/editairline','AirlineController@edit_row');
Route::get('/airline_display1/{id}', 'AirlineController@display_with_status');
Route::get('/airline_display/{id}', 'AirlineController@filter');

/****************customer************** */
Route::get('/customer_add', 'customerController@add');
Route::get('/display_row/{id}', 'customerController@display_row');
Route::get('/customer_edit/{id}', 'customerController@display_row_edit');
Route::get('/customer_display', 'customerController@display');
Route::get('/customer_display/{id}', 'customerController@filter');
Route::get('/customer_display1/{id}', 'customerController@display_with_status');
Route::get('/customer_delete/{id}', 'customerController@hide_row');
Route::get('/customer/is_active/{id}', 'customerController@is_active');
Route::get('/customer/no_active/{id}', 'customerController@no_active');
Route::get('/is_vip/{id}', 'customerController@vip');
Route::get('/no_vip/{id}', 'customerController@no_vip');
Route::post('/addcustomer','customerController@save1');
Route::post('/editcustomer','customerController@edit_row');
/*****************Adds************** */
Route::get('/adds_add', 'AddsController@add');
Route::get('/adds_edit/{id}', 'AddsController@display_row');
Route::get('/adds_user/{id}', 'AddsController@adds_user');
Route::get('/adds_user_delete/{id}', 'AddsController@hide_user_row');
Route::get('/adds_user_delete1/{id}/{user}', 'AddsController@delete_user_row1');
Route::get('/adds_user_add/{id}/{user}', 'AddsController@add_user_row');
Route::get('/adds_delete/{id}', 'AddsController@hide_row');
Route::get('/is_active_adds/{id}', 'AddsController@is_active');
Route::get('/no_active_adds/{id}', 'AddsController@is_not_active');
Route::get('/adds_display/{id}', 'AddsController@filter');
Route::get('/adds_display1/{id}', 'AddsController@display_with_status');
Route::get('/adds_display', 'AddsController@display');
Route::get('/adds_user_display', 'AddsController@adds_user_display');
Route::get('/adds_user_display/{id}', 'AddsController@user_filter');
Route::get('/adds_user_display_row/{id}', 'AddsController@adds_user_display_row');
Route::get('/adds_user_display_u/{id}', 'AddsController@adds_user_display_u');
Route::get('/ok/{id}', 'AddsController@ok');
Route::get('/cansel/{id}', 'AddsController@cansel');
Route::post('/addadds','AddsController@save1');
Route::post('/editadds','AddsController@edit_row');
/*****************users************** */
Route::get('/user_add', 'uuserController@add');
Route::get('/user_edit/{id}', 'uuserController@display_row');
Route::get('/user_edit/{id}', 'uuserController@display_row');
Route::get('/is_active_user/{id}', 'uuserController@is_active');
Route::get('/no_active_user/{id}', 'uuserController@is_not_active');
Route::get('/user_display/{id}', 'uuserController@filter');
Route::get('/user_delete/{id}', 'uuserController@hide_row');
Route::get('/employee_dept/{id}', 'uuserController@employee_dept');
Route::get('/employee_data/{id}', 'uuserController@employee_data');
Route::get('/user_display', 'uuserController@display');
Route::get('/user_display/{id}', 'uuserController@filter');
Route::get('/user_display1/{id}', 'uuserController@display_with_status1');
Route::post('/adduser','uuserController@save17');
Route::post('/edituser','uuserController@edit_row');
Route::get('/checkmail/{id}','uuserController@checkmail');
/*****************users************** */
/*****************ROLE************** */
Route::get('/role_add', 'RoleController@add');
Route::get('/role_edit/{id}', 'RoleController@display_row');
Route::get('/role_delete/{id}', 'RoleController@hide_row');
Route::get('/is_active/{id}', 'RoleController@is_active');
Route::get('/no_active/{id}', 'RoleController@is_not_active');
Route::get('/role_display/{id}', 'RoleController@filter');
Route::get('/role_display', 'RoleController@display');
Route::get('/role_user_display', 'RoleController@display_role_user');
Route::get('/role_display1/{id}', 'RoleController@display_with_status');
Route::get('/role_user_display1/{id}', 'RoleController@display_with_status1');
Route::get('/role_user_display18/{id}', 'RoleController@display_role_user18');
Route::get('/user_role_delete/{u_id}', 'RoleController@role_user_hide_row');
Route::get('/add_role_user', 'RoleController@add_role_user');
Route::post('/addrole','RoleController@save1');
Route::post('/addroleuser','RoleController@save_user_role');
Route::get('/addroleuser1/{r}/{u}/{h}','RoleController@save_user_roleyy');
Route::get('/addroleuser2/{r}/{u}/{h}','RoleController@save_user_roleyy2');
Route::post('/editrole','RoleController@edit_row');

//employees
Route::get('employees', 'EmployeeController@index');
Route::get('employees/active', 'EmployeeController@Activate');
Route::get('/employees/insert', 'EmployeeController@insert');
Route::post('/employees/saved', 'EmployeeController@saved');
Route::get('/employees/employee_delete/{id}','EmployeeController@hide_row');
Route::get('employees/employee-edit/{id}', 'EmployeeController@display_row');
Route::get('/employees/employee-show/{id}','EmployeeController@show_row');
Route::post('employees/editemployee','EmployeeController@edit_row');
//department
Route::get('department', 'DepartmentController@index');
Route::get('/department/insert', 'DepartmentController@saved');
Route::get('department/department-edit/{id}','DepartmentController@department_edit');
Route::get('/department/department_delete/{id}', 'DepartmentController@hide_row');
Route::get('department/department-edit/{id}', 'DepartmentController@display_row');
Route::get('department/editdepartment','DepartmentController@edit_row');
Route::get('/is_active_dept/{id}', 'AddsController@is_active');
Route::get('/no_active_dept/{id}', 'AddsController@is_not_active');
/*      ------------  Reports  ------------          */
Route::get('/supplierRepo', 'ReportController@display');
Route::get('/is_active_supplier/{id}', 'ReportController@is_active');
Route::get('/no_active_supplier/{id}', 'ReportController@is_not_active');
Route::get('/supplierRepo/{id}', 'ReportController@filter');
Route::get('display_rowRepo/{id}', 'ReportController@display_row');
Route::get('/export_excel', 'ReportController@ExportIntoExcel');
Route::get('services','ServiceController@index');
Route::get('/service/insert', 'ServiceController@insert');
Route::get('/service/saved', 'ServiceController@saved');
Route::get('/service/service_delete/{id}','ServiceController@hide_row');
Route::get('/service/service-edit/{id}','ServiceController@display_row');
Route::get('/service/editservice/','ServiceController@edit_row');
Route::get('/service/sales/','ServiceController@show');
/********************supplier***************** */
  Route::get('/suplier/suplier_row','SuplierController@show_row');
  Route::get('/addSupplier', 'SupplierController@add');
  Route::get('/displaySupplier', 'SupplierController@display');
  Route::get('/editSupplier/{id}', 'SupplierController@display_row');
  Route::get('/deleteSupplier/{id}', 'SupplierController@hide_row');
  Route::post('/add_supplier','SupplierController@save1');
  Route::post('/edit_supplier','SupplierController@edit_row');
  Route::get('/is_active_supplier/{id}', 'SupplierController@is_active');
  Route::get('/no_active_supplier/{id}', 'SupplierController@is_not_active');
  Route::get('/displaySupplier/{id}', 'SupplierController@filter');
Route::get('/service/bus_send/{id}','BusServiceController@send_bus');
Route::get('/service/send_visa/{id}','ServiceController@send_visa');
Route::get('/service/send_car/{id}','ServiceController@send_car');
Route::get('/service/send_hotel/{id}','ServiceController@send_hotel');
Route::get('/service/send_gen/{id}','ServiceController@send_gen');
Route::get('/service/send_med/{id}','ServiceController@send_med');
//ti send or delete multi  row in table service
Route::delete('/deleteallticket','ServiceController@deleteAllticket');
Route::delete('/sendallticket','ServiceController@sendallticket');
Route::delete('/deleteallhotel','ServiceController@deleteAllhotel');
Route::delete('/sendallhotel','ServiceController@sendallhotel');
Route::delete('/deleteallbus','BusServiceController@deleteAllbus');
Route::delete('/sendallbus','BusServiceController@sendAllbus');
Route::delete('/deleteallcar','ServiceController@deleteAllcar');
Route::delete('/sendallcar','ServiceController@sendallcar');
Route::delete('/deleteallhotel','ServiceController@deleteallhotel');
Route::delete('/sendallhotel','ServiceController@sendallhotel');
Route::delete('/deleteallvisa','ServiceController@deleteallvisa');
Route::delete('/sendallvisa','ServiceController@sendallvisa');
Route::delete('/deleteallmed','ServiceController@deleteallmed');
Route::delete('/sendallmed','ServiceController@sendallmed');
Route::delete('/deleteallgen','ServiceController@deleteallgen');
Route::delete('/sendallgen','ServiceController@sendallgen');

//Supplier

Route::get('/remark','dashboard@remark');
Route::get('/dashboard/addBusRemark','dashboard@addBusRemark');
Route::get('/dashboard/addTicketRemark','dashboard@addTicketRemark');
Route::get('/dashboard/addCarRemark','dashboard@addCarRemark');
Route::get('/dashboard/addHotelRemark','dashboard@addHotelRemark');
Route::get('/dashboard/addVisaRemark','dashboard@addVisaRemark');
Route::get('/dashboard/addMedRemark','dashboard@addMedRemark');
Route::get('/dashboard/addGenRemark','dashboard@addGenRemark');
Route::get('/airline/airline_row','AirlineController@show_row');
Route::get('/suplier/suplier_row','SuplierController@show_row');
Route::get('/addSupplier', 'SupplierController@add');
Route::get('/displaySupplier', 'SupplierController@display');
Route::get('/editSupplier/{id}', 'SupplierController@display_row');
Route::get('/deleteSupplier/{id}', 'SupplierController@hide_row');
Route::post('/add_supplier','SupplierController@save1');
Route::post('/edit_supplier','SupplierController@edit_row');
Route::get('/is_active_supplier/{id}', 'SupplierController@is_active');
Route::get('/no_active_supplier/{id}', 'SupplierController@is_not_active');
Route::get('/displaySupplier/{id}', 'SupplierController@filter');

//


  });

 Route::group(['middleware' => ['auth','role:accountant']], function() {
  Route::get('/accountant','accountantController@accountant_view');
  Route::get('/accountant/accountant_finish_by/{id}','accountantController@accountant_finish_by');
  Route::get('/accountant/accountant_finish_all/{id}','accountantController@accountant_finish_all');
  Route::get('/accountant_review','accountantController@accountant_review_all');
  Route::get('/accountant_review/{id}','accountantController@accountant_review');
  Route::get('/accountant_review/{id}/{status}','accountantController@accountant_review_with_status');
  Route::get('/accountant_finish/{id}/{user}','accountantController@accountant_finish');
  Route::get('/accountant/ticket/{id}','accountantController@ticket');
  Route::get('/accountant/bus/{id}','accountantController@bus');
  Route::get('/accountant/car/{id}','accountantController@car');
  Route::get('/accountant/general/{id}','accountantController@general');
  Route::get('/accountant/medical/{id}','accountantController@medical');
  Route::get('/accountant/hotel/{id}','accountantController@hotel');
  Route::get('/accountant/visa/{id}','accountantController@visa');
  Route::get('/accountant/bill_num/{servic}/{main}/{bill}/{how}/{rec}/{num}','accountantController@bill_num');
  Route::get('/accountant/add_remark/{col}/{old}/{new}/{status}','accountantController@add_remark');
  Route::get('/accountant/send_remark/{m}/{s}/{to}/{from}/{number}','accountantController@send_remark');
  Route::get('/accountant/add_bookmark/{m}/{s}/{c}/{h}','accountantController@add_bookmark');
  Route::get('/accountant/remove_bookmark/{m}/{s}/{h}','accountantController@remove_bookmark');
  Route::get('/accountant/display_remark_body/{m}/{s}','accountantController@display_remark_body');
 Route::get('/accountant/filter_item/{c}/{op}/{v}','accountantController@add_filer');
 Route::get('/accountant/filter_do','accountantController@display_filter');
 Route::get('/accountant/DISPLAY_FILTER1','accountantController@DISPLAY_FILTER1');
  Route::get('/accountant/clear_session','accountantController@clear_session');

});
Route::group(['middleware' => ['auth','role:sale_manager']], function() {
  //add error log 
  
  Route::get('/sales','SalesManagerController@sales_view');
  Route::get('/sales_review/{id}','SalesManagerController@sales_review');
  Route::get('/sales/ticket/{id}','SalesManagerController@ticket');
  Route::get('/sales_finish/{id}/{user}','SalesManagerController@sales_finish');
  Route::get('/sales/ticket/{id}','SalesManagerController@ticket');
  Route::get('/sales/bus/{id}','SalesManagerController@bus');
  Route::get('/sales/car/{id}','SalesManagerController@car');
  Route::get('/sales/general/{id}','SalesManagerController@general');
  Route::get('/sales/medical/{id}','SalesManagerController@medical');
  Route::get('/sales/hotel/{id}','SalesManagerController@hotel');
  Route::get('/sales/visa/{id}','SalesManagerController@visa');
  Route::get('/sales/saved/{servic}/{main}/{bill}/{how}/{rec}','SalesManagerController@saved');
  Route::get('/sales/add_remark/{col}/{old}/{new}/{status}','SalesManagerController@add_remark');
  Route::get('/sales/send_remark/{m}/{s}/{to}/{from}/{number}','SalesManagerController@send_remark');

// Sales Manager
Route::get('/remark','dashboard@remark');
Route::get('/dashboard/addBusRemark','dashboard@addBusRemark');
Route::get('/dashboard/addTicketRemark','dashboard@addTicketRemark');
Route::get('/dashboard/addCarRemark','dashboard@addCarRemark');
Route::get('/dashboard/addHotelRemark','dashboard@addHotelRemark');
Route::get('/dashboard/addVisaRemark','dashboard@addVisaRemark');
Route::get('/dashboard/addMedRemark','dashboard@addMedRemark');
Route::get('/dashboard/addGenRemark','dashboard@addGenRemark');
Route::get('/displaySalesManager', 'SalesManagerController@display');
Route::post('/service/add_ticket/','TicketServiceController@add_ticket');
  Route::get('/service/update_ticket/{id}','TicketServiceController@update_ticket');
  Route::get('/service/update_bus/{id}','BusServiceController@update_bus');
  Route::get('/service/update_car/{id}','CarServiceController@update_car');
  Route::get('/service/update_hotel/{id}','HotelServiceController@update_hotel');
  Route::get('/service/update_visa/{id}','VisaServiceController@update_visa');
  Route::get('/service/update_med/{id}','MedicalServiceController@update_med');
  Route::get('/service/update_gen/{id}','GeneralServiceController@update_gen');
  Route::post('/service/updateTicket','TicketServiceController@updateTicket');
  Route::post('/service/updateBus','BusServiceController@updateBus');
  Route::post('/service/updateCar','CarServiceController@updateCar');
  Route::post('/service/updateHotel','HotelServiceController@updateHotel');
  Route::post('/service/updateVisa','VisaServiceController@updateVisa');
  Route::post('/service/updateMed','MedicalServiceController@updateMed');
  Route::post('/service/updateGen','GeneralServiceController@updateGen');
  Route::get('/service/update_ticketAttachment/{id}','TicketServiceController@ticketAttachment');
  Route::post('/service/add_bus/','BusServiceController@add_bus');
  Route::post('/service/add_hotel/','HotelServiceController@add_hotel');
  Route::post('/service/add_car/','CarServiceController@add_car');
  Route::post('/service/add_visa/','VisaServiceController@add_visa');
  Route::post('/service/add_service/','GeneralServiceController@add_service');
  Route::post('/service/add_medical/','MedicalServiceController@add_medical');
  Route::get('/service/sales_repo','ServiceController@show_repo');
  Route::get('/service/ticket','TicketServiceController@ticket');
  
  Route::get('/service/sent_ticket/{id}','TicketServiceController@sent_ticket');
  Route::get('/service/sent_bus/{id}','BusServiceController@sent_bus');
  Route::get('/service/sent_emp_bus','BusServiceController@sent_add_emp');
  Route::get('/service/sent_hotel/{id}','HotelServiceController@sent_hotel');
  Route::get('/service/sent_car/{id}','CarServiceController@sent_car');
  Route::get('/service/sent_visa/{id}','VisaServiceController@sent_visa');
  Route::get('/service/sent_medical/{id}','MedicalServiceController@sent_med');
  Route::get('/service/sent_general/{id}','GeneralServiceController@sent_gen');
  Route::get('/service/bus','BusServiceController@bus');
  Route::get('/service/car','CarServiceController@car');
  Route::get('/service/visa','VisaServiceController@visa');
  Route::get('/service/medical','MedicalServiceController@medical');
  Route::get('/service/hotel','HotelServiceController@hotel');
  Route::get('/service/general','GeneralServiceController@general');
  Route::get('/service/show_ticket/{id}','TicketServiceController@show_ticket');
  Route::get('/service/show_bus/{id}','BusServiceController@show_bus');
  Route::get('/service/show_emp_bus','BusServiceController@show_add_emp');
  Route::get('/service/show_hotel/{id}','HotelServiceController@show_hotel');
  Route::get('/service/show_car/{id}','CarServiceController@show_car');
  Route::get('/service/show_visa/{id}','VisaServiceController@show_visa');
  Route::get('/service/show_medical/{id}','MedicalServiceController@show_med');
  Route::get('/service/show_general/{id}','GeneralServiceController@show_gen');
  
  
  Route::get('/service/sent_ticket/{id}','TicketServiceController@sent_ticket');
  Route::get('/service/sent_bus/{id}','BusServiceController@sent_bus');
  Route::get('/service/sent_emp_bus','BusServiceController@sent_add_emp');
  Route::get('/service/sent_hotel/{id}','HotelServiceController@sent_hotel');
  Route::get('/service/sent_car/{id}','CarServiceController@sent_car');
  Route::get('/service/sent_visa/{id}','VisaServiceController@sent_visa');
  Route::get('/service/sent_medical/{id}','MedicalServiceController@sent_med');
  Route::get('/service/sent_general/{id}','GeneralServiceController@sent_gen');
  Route::get('/service/ticket_delete/{id}','TicketServiceController@hide_ticket');
  Route::get('/service/bus_delete/{id}','BusServiceController@hide_bus');
  Route::get('/service/hotel_delete/{id}','HotelServiceController@hide_hotel');
  Route::get('/service/car_delete/{id}','CarServiceController@hide_car');
  Route::get('/service/visa_delete/{id}','VisaServiceController@hide_visa');
  Route::get('/service/med_delete/{id}','MedicalServiceController@hide_med');
  Route::get('/service/gen_delete/{id}','GeneralServiceController@hide_gen');
  Route::get('/service/ticket_send/{id}','TicketServiceController@send_ticket');
  Route::get('/service/bus_send/{id}','BusServiceController@send_bus');
  Route::get('/service/send_visa/{id}','VisaServiceController@send_visa');
  Route::get('/service/send_car/{id}','CarServiceController@send_car');
  Route::get('/service/send_hotel/{id}','HotelServiceController@send_hotel');
  Route::get('/service/send_gen/{id}','GeneralServiceController@send_gen');
  Route::get('/service/send_med/{id}','MedicalServiceController@send_med');
  Route::post('/deleteallticket','TicketServiceController@deleteAllticket');
  Route::post('/sendallticket','TicketServiceController@sendallticket');
  Route::post('/deleteallbus','BusServiceController@deleteAllbus');
  Route::post('/sendallbus','BusServiceController@sendAllbus');
  Route::post('/deleteallcar','CarServiceController@deleteAllcar');
  Route::post('/sendallcar','CarServiceController@sendallcar');
  Route::post('/deleteallhotel','HotelServiceController@deleteallhotel');
  Route::post('/sendallhotel','HotelServiceController@sendallhotel');
  Route::post('/deleteallvisa','VisaServiceController@deleteallvisa');
  Route::post('/sendallvisa','VisaServiceController@sendallvisa');
  Route::post('/deleteallmed','MedicalServiceController@deleteallmed');
  Route::post('/sendallmed','MedicalServiceController@sendallmed');
  Route::post('/deleteallgen','GeneralServiceController@deleteallgen');
  Route::post('/sendallgen','GeneralServiceController@sendallgen');
  Route::get('/service/sales_repo','ServiceController@show_repo');
  Route::get('/airline/airline_row','AirlineController@show_row');

Route::get('/service/generate_bus','BusServiceController@generate');
Route::get('/service/generate_car','CarServiceController@generate');
Route::get('/service/generate_hotel','HotelServiceController@generate');
Route::get('/service/generate_ticket','TicketServiceController@generate');
Route::get('/service/generate_visa','VisaServiceController@generate');
Route::get('/service/generate_gen','GeneralServiceController@generate');
Route::get('/service/generate_med','MedicalServiceController@generate');
  Route::get('/suplier/suplier_row','SupplierController@show_row');

});
Route::group(['middleware' => ['auth','role:sale_executive|sale_manager']], function() {

  //rout for error from manager
    Route::get('/salesBusLog','BusServiceController@errorBus');
Route::get('/salesCarLog','CarServiceController@errorCar');
Route::get('/salesHotelLog','HotelServiceController@errorHotel');
Route::get('/salesTicketLog','TicketServiceController@errorTicket');
Route::get('/salesVisaLog','VisaServiceController@errorVisa');
Route::get('/salesMedLog','MedicalServiceController@errorMed');
Route::get('/salesGenLog','GeneralServiceController@errorGen');


//rout for reject service
Route::get('/reject_bus','BusServiceController@reject_bus');
Route::get('/reject_car','CarServiceController@reject_car');
Route::get('/reject_hotel','HotelServiceController@reject_hotel');
Route::get('/reject_ticket','TicketServiceController@reject_ticket');
Route::get('/reject_visa','VisaServiceController@reject_visa');
Route::get('/reject_med','MedicalServiceController@reject_med');
Route::get('/reject_gen','GeneralServiceController@reject_gen');

//rout for service added by other
Route::get('/emp_bus','BusServiceController@emp_bus');
Route::get('/emp_bus/accept/{id}','BusServiceController@accept');
Route::get('/emp_bus/ignore/{id}','BusServiceController@ignore');
Route::get('/emp_car','CarServiceController@emp_car');
Route::get('/emp_car/accept/{id}','CarServiceController@accept');
Route::get('/emp_car/ignore/{id}','CarServiceController@ignore');


Route::get('/emp_hotel','HotelServiceController@emp_hotel');
Route::get('/emp_hotel/accept/{id}','HotelServiceController@accept');
Route::get('/emp_hotel/ignore/{id}','HotelServiceController@ignore');


Route::get('/emp_ticket','TicketServiceController@emp_ticket');
Route::get('/emp_ticket/accept/{id}','TicketServiceController@accept');
Route::get('/emp_ticket/ignore/{id}','TicketServiceController@ignore');


Route::get('/emp_visa','VisaServiceController@emp_visa');
Route::get('/emp_visa/accept/{id}','VisaServiceController@accept');
Route::get('/emp_visa/ignore/{id}','VisaServiceController@ignore');


Route::get('/emp_gen','GeneralServiceController@emp_gen');
Route::get('/emp_gen/accept/{id}','GeneralServiceController@accept');
Route::get('/emp_gen/ignore/{id}','GeneralServiceController@ignore');


Route::get('/emp_med','MedicalServiceController@emp_med');
Route::get('/emp_med/accept/{id}','MedicalServiceController@accept');
Route::get('/emp_med/ignore/{id}','MedicalServiceController@ignore');


     Route::post('/service/add_ticket/','TicketServiceController@add_ticket');
  Route::get('/service/update_ticket/{id}','TicketServiceController@update_ticket');
  
  Route::get('/service/update_bus/{id}','BusServiceController@update_bus');
  Route::get('/service/update_car/{id}','CarServiceController@update_car');
  Route::get('/service/update_hotel/{id}','HotelServiceController@update_hotel');
  Route::get('/service/update_visa/{id}','VisaServiceController@update_visa');
  Route::get('/service/update_med/{id}','MedicalServiceController@update_med');
  Route::get('/service/update_gen/{id}','GeneralServiceController@update_gen');
  Route::post('/service/updateTicket','TicketServiceController@updateTicket');
  Route::post('/service/updateBus','BusServiceController@updateBus');
  Route::post('/service/updateCar','CarServiceController@updateCar');
  Route::post('/service/updateHotel','HotelServiceController@updateHotel');
  Route::post('/service/updateVisa','VisaServiceController@updateVisa');
  Route::post('/service/updateMed','MedicalServiceController@updateMed');
  Route::post('/service/updateGen','GeneralServiceController@updateGen');
  Route::get('/service/update_ticketAttachment/{id}','TicketServiceController@ticketAttachment');
  Route::post('/service/add_bus/','BusServiceController@add_bus');
  Route::post('/service/add_hotel/','HotelServiceController@add_hotel');
  Route::post('/service/add_car/','CarServiceController@add_car');
  Route::post('/service/add_visa/','VisaServiceController@add_visa');
  Route::post('/service/add_service/','GeneralServiceController@add_service');
  Route::post('/service/add_medical/','MedicalServiceController@add_medical');
  Route::get('/service/sales_repo','ServiceController@show_repo');
  Route::get('/service/ticket','TicketServiceController@ticket');
  Route::get('/service/bus','BusServiceController@bus');
  Route::get('/service/car','CarServiceController@car');
  Route::get('/service/visa','VisaServiceController@visa');
  Route::get('/service/medical','MedicalServiceController@medical');
  Route::get('/service/hotel','HotelServiceController@hotel');
  Route::get('/service/general','GeneralServiceController@general');
  Route::get('/service/show_ticket/{id}','TicketServiceController@show_ticket');
  Route::get('/service/show_bus/{id}','BusServiceController@show_bus');
  Route::get('/service/show_emp_bus','BusServiceController@show_add_emp');
  Route::get('/service/show_hotel/{id}','HotelServiceController@show_hotel');
  Route::get('/service/show_car/{id}','CarServiceController@show_car');
  Route::get('/service/show_visa/{id}','VisaServiceController@show_visa');
  Route::get('/service/show_medical/{id}','MedicalServiceController@show_med');
  Route::get('/service/show_general/{id}','GeneralServiceController@show_gen');
  
  Route::get('/service/sent_ticket/{id}','TicketServiceController@sent_ticket');
  Route::get('/service/sent_bus/{id}','BusServiceController@sent_bus');
  Route::get('/service/sent_emp_bus','BusServiceController@sent_add_emp');
  Route::get('/service/sent_hotel/{id}','HotelServiceController@sent_hotel');
  Route::get('/service/sent_car/{id}','CarServiceController@sent_car');
  Route::get('/service/sent_visa/{id}','VisaServiceController@sent_visa');
  Route::get('/service/sent_medical/{id}','MedicalServiceController@sent_med');
  Route::get('/service/sent_general/{id}','GeneralServiceController@sent_gen');
  Route::get('/service/ticket_delete/{id}','TicketServiceController@hide_ticket');
  Route::get('/service/bus_delete/{id}','BusServiceController@hide_bus');
  Route::get('/service/hotel_delete/{id}','HotelServiceController@hide_hotel');
  Route::get('/service/car_delete/{id}','CarServiceController@hide_car');
  Route::get('/service/visa_delete/{id}','VisaServiceController@hide_visa');
  Route::get('/service/med_delete/{id}','MedicalServiceController@hide_med');
  Route::get('/service/gen_delete/{id}','GeneralServiceController@hide_gen');
  Route::get('/service/ticket_send/{id}','TicketServiceController@send_ticket');
  Route::get('/service/bus_send/{id}','BusServiceController@send_bus');
  Route::get('/service/send_visa/{id}','VisaServiceController@send_visa');
  Route::get('/service/send_car/{id}','CarServiceController@send_car');
  Route::get('/service/send_hotel/{id}','HotelServiceController@send_hotel');
  Route::get('/service/send_gen/{id}','GeneralServiceController@send_gen');
  Route::get('/service/send_med/{id}','MedicalServiceController@send_med');
  Route::post('/deleteallticket','TicketServiceController@deleteAllticket');
  Route::post('/sendallticket','TicketServiceController@sendallticket');
  Route::post('/deleteallbus','BusServiceController@deleteAllbus');
  Route::post('/sendallbus','BusServiceController@sendAllbus');
  Route::post('/deleteallcar','CarServiceController@deleteAllcar');
  Route::post('/sendallcar','CarServiceController@sendallcar');
  Route::post('/deleteallhotel','HotelServiceController@deleteallhotel');
  Route::post('/sendallhotel','HotelServiceController@sendallhotel');
  Route::post('/deleteallvisa','VisaServiceController@deleteallvisa');
  Route::post('/sendallvisa','VisaServiceController@sendallvisa');
  Route::post('/deleteallmed','MedicalServiceController@deleteallmed');
  Route::post('/sendallmed','MedicalServiceController@sendallmed');
  Route::post('/deleteallgen','GeneralServiceController@deleteallgen');
  Route::post('/sendallgen','GeneralServiceController@sendallgen');
  Route::get('/service/sales_repo','ServiceController@show_repo');
  Route::get('/airline/airline_row','AirlineController@show_row');
  Route::get('/reject_service','TicketServiceController@reject');
  Route::get('/show_remark','ServiceController@show_remark');

Route::get('/service/generate_bus','BusServiceController@generate');
Route::get('/service/generate_car','CarServiceController@generate');
Route::get('/service/generate_hotel','HotelServiceController@generate');
Route::get('/service/generate_ticket','TicketServiceController@generate');
Route::get('/service/generate_visa','VisaServiceController@generate');
Route::get('/service/generate_gen','GeneralServiceController@generate');
Route::get('/service/generate_med','MedicalServiceController@generate');
  Route::get('/suplier/suplier_row','SupplierController@show_row');
});

Route::get('/clear-cache',function(){
  Artisan::call('cache:clear');
  return 'cache cleean';
});
  //Route::get('/airline/airline_row','AirlineController@show_row');

  //Route::get('/suplier/suplier_row','SuplierController@show_row');
Route::get('/index', function () {
  return view('index');
});
Route::get('test','test@index');