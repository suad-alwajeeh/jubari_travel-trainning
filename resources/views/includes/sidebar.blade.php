<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src={{asset('assets/img/logo.png')}} alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .9;background-color: white;">
        <span class="brand-text font-weight-light">JUBARI TRAVEL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" id="su_user_image">

            </div>
            <div class="info">

                <a href="#" class="d-block" id="su_user_name"> </a>
            </div>
        </div>
        @php

        $_GLOBALS['admin_link']='
     
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-ad  "></i>
                <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/user_add" class="nav-link">
                        <i class="nav-icon far fa-circle nav-icon  "></i>
                        <p>Add new</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/user_display" class="nav-link">
                        <i class=" nav-icon far fa-circle nav-icon  "></i>
                        <p>Display users</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
                <a href="/remark" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                 <p>Services Status </p>
                </a>
              </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-ad"></i>
                <p>
                    advertisements
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/adds_add" class="nav-link">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>Add new</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/adds_display" class="nav-link">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>Display advertisements</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/adds_user_display" class="nav-link">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>users advertisements</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-building  "></i>
                            <p>
                    Department
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/department/insert" class="nav-link">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>Add new</p>
                    </a>
                </li>
                <li class="nav-item">
                <a href="/department" class="nav-link">
            <i class="nav-icon far fa-circle nav-icon"></i>  
                          <p>Display Department</p>
            </a>
                <li class="nav-item">
                    <a href="/adds_user_display" class="nav-link">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>users advertisements</p>
                    </a>
                </li>

            </ul>        
            
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                <p>
                    Employee
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/employees/insert" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon"></i>
                        <p>Add Employee </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/employees" class="nav-link">
                        <i class="nav-icon fas fa-eye nav-icon"></i>
                        <p>Display Employee</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon nav-icon fas fa-tasks"></i>
                <p>
                    ROLES
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/role_add" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon"></i>
                        <p>ADD NEW</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/role_display" class="nav-link">
                        <i class="nav-icon fas fa-eye nav-icon"></i>
                        <p>DISPLAY ALL</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/role_user_display" class="nav-link">
                        <i class="nav-icon far fa-eye nav-icon"></i>
                        <p>DISPLAY users roles</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                <p>
                    Customers
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/customer_add" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon"></i>
                        <p>Add Customer </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/customer_display" class="nav-link">
                        <i class="nav-icon fas fa-eye nav-icon"></i>
                        <p>Display Customers</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon nav-icon fas fa-plane"></i>
                <p>
                    Airline
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/airline_add" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon"></i>
                        <p>add airline </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/airline_display" class="nav-link">
                        <i class="nav-icon fas fa-eye nav-icon"></i>
                        <p>disply airline</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon nav-icon fas fa-users"></i>
                <p>
                    Supplier
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/addSupplier" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon"></i>
                        <p>Add Supplier </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/displaySupplier" class="nav-link">
                        <i class="nav-icon fas fa-eye nav-icon"></i>
                        <p>Disply Suppliers</p>
                    </a>
                </li>

            </ul>
        </li>
      
        <li class="nav-item">
            <a href="/services" class="nav-link">
                <i class="nav-icon fas fa-user-cog nav-icon"></i>
                <p>Service</p>
            </a>
        </li>
      
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon nav-icon fas fa-tasks"></i>
                <p>
                    Reports
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="/supplierRepo" class="nav-link">
                        <i class="nav-icon fas fa-eye nav-icon"></i>
                        <p>Display Suppliers Reports</p>
                    </a>
                </li>
                <li class="nav-item">
            <a href="/chatRepo" class="nav-link">
                <i class="nav-icon far fa-comments"></i>
                <p> CHAT REPORT</p>
            </a>
        </li>

            </ul>
        </li>
        ';
        $_GLOBALS['Sales_Executive']='

        <li class="nav-item">
            <a href="/service/sales_repo/" class="nav-link">
                <i class="nav-icon fas fa-plus-circle nav-icon"></i>
                <p>Sales Executive </p>

            </a>
        </li>

        <li class="nav-item">
            <a href="/show_remark" class="nav-link">
                <i class="nav-icon fas  fa-circle nav-icon"></i>
                <p> Remark</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/salesTicketLog" class="nav-link">
                <i class="nav-icon fas fa-exclamation-triangle  "></i>
                <p> ErrorLog</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/emp_ticket" class="nav-link">
                <i class="nav-icon fas fa-circle nav-icon"></i>
                <p> Outstanding Services</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/reject_ticket" class="nav-link">
                <i class="nav-icon fas fa-circle nav-icon"></i>
                <p> Rejected Services</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-plane" aria-hidden="true"></i>
                <p>
                    Ticket Service
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                    <a href="/service/ticket" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                        <p>
                            Add Ticket
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/show_ticket/1" class="nav-link">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p> Saved Ticket </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/sent_ticket/2" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p> Sent Ticket </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/excutive_finish/1/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Ticket Service </p>
                    </a>
                </li>
              

            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hotel" aria-hidden="true"></i>
                <p>
                    Hotel Service
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                    <a href="/service/hotel" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                        <p>
                            Add Hotel
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/show_hotel/1" class="nav-link">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p> Saved Hotel </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/sent_hotel/2" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p> Sent Hotel </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/excutive_finish/5/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Hotel Service </p>
                    </a>
                </li>
               

            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-car" aria-hidden="true"></i>
                <p>
                    Car Service
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                    <a href="/service/car" class="nav-link">
                        <i class="fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                        <p>
                            Add Car
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/show_car/1" class="nav-link">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p> Saved Car </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/sent_car/2" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p> Sent Car </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/excutive_finish/3/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Car Service </p>
                    </a>
                </li>
               

            </ul>
        </li>



        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bus" aria-hidden="true"></i>
                <p>
                    Bus Service
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                    <a href="/service/bus" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                        <p>
                            Add Bus
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/show_bus/1" class="nav-link">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p> Saved Bus </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/sent_bus/2" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p> Sent Bus </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/excutive_finish/3/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Bus Service </p>
                    </a>
                </li>
               

            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-passport" aria-hidden="true"></i>
                <p>
                    Visa Service
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                    <a href="/service/visa" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                        <p>
                            Add Visa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/show_visa/1" class="nav-link">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p> Saved Visa </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/sent_visa/2" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p> Sent Visa </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/excutive_finish/6/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Visa Service </p>
                    </a>
                </li>
                

            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-cog" aria-hidden="true"></i>
                <p>
                    General Service
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                    <a href="/service/general" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                        <p>
                            Add General Service
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/show_general/1" class="nav-link">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p> Saved General Service </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/sent_gen/2" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p> Sent General Service </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/excutive_finish/7/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive General Service </p>
                    </a>
                </li>
               

            </ul>
        </li>


        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hospital" aria-hidden="true"></i>
                <p>
                    Medical Service
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                    <a href="/service/medical" class="nav-link">
                        <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                        <p>
                            Add Medical Service
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/show_med/1" class="nav-link">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p> Saved Medical Service </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/service/sent_med/2" class="nav-link">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p> Sent Medical Service </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/excutive_finish/4/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Medical Service </p>
                    </a>
                </li>
                

            </ul>
        </li>

        </li>';

        $_GLOBALS['Sales_Manager']='
        <li class="nav-item">
            <a href="/sales" class="nav-link">
                <i class="nav-icon fas fa-user nav-icon"></i>
                <p>Sales Manager</p>

            </a>
        </li>
        <li class="nav-item">
                <a href="/remark" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                 <p>Services Status </p>
                </a>
              </li>

        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user" aria-hidden="true"></i>
            <p>
                Sales Executive
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/service/sales_repo/" class="nav-link">
                    <i class="nav-icon fas fa-plus-circle nav-icon"></i>
                    <p>Sales Executive </p>
                    <i class="right fas fa-angle-left"></i>

                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-plane" aria-hidden="true"></i>
                    <p>
                        Ticket Service
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                        <a href="/service/ticket" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                            <p>
                                Add Ticket
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/show_ticket/1" class="nav-link">
                            <i class="nav-icon fas fa-share-square"></i>
                            <p> Saved Ticket </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/sent_ticket/2" class="nav-link">
                            <i class="nav-icon fas fa-certificate"></i>
                            <p> Sent Ticket </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="/excutive_finish/1/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Ticket Service </p>
                    </a>
                </li>
                   

                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-hotel" aria-hidden="true"></i>
                    <p>
                        Hotel Service
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                        <a href="/service/hotel" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                            <p>
                                Add Hotel
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/show_hotel/1" class="nav-link">
                            <i class="nav-icon fas fa-share-square"></i>
                            <p> Saved Hotel </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/sent_hotel/2" class="nav-link">
                            <i class="nav-icon fas fa-certificate"></i>
                            <p> Sent Hotel </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="/excutive_finish/5/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Hotel Service </p>
                    </a>
                </li>
                   

                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-car" aria-hidden="true"></i>
                    <p>
                        Car Service
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                        <a href="/service/car" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                            <p>
                                Add Car
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/show_car/1" class="nav-link">
                            <i class="nav-icon fas fa-share-square"></i>
                            <p> Saved Car </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/sent_car/2" class="nav-link">
                            <i class="nav-icon fas fa-certificate"></i>
                            <p> Sent Car </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="/excutive_finish/3/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Car Service </p>
                    </a>
                </li>
                    

                </ul>
            </li>



            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-bus" aria-hidden="true"></i>
                    <p>
                        Bus Service
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                        <a href="/service/bus" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                            <p>
                                Add Bus
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/service/show_bus/1" class="nav-link">
                            <i class="nav-icon fas fa-share-square"></i>
                            <p> Saved Bus </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/sent_bus/2" class="nav-link">
                            <i class="nav-icon fas fa-certificate"></i>
                            <p> Sent Bus </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="/excutive_finish/2/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Bus Service </p>
                    </a>
                </li>
                   
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-passport" aria-hidden="true"></i>
                    <p>
                        Visa Service
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                        <a href="/service/visa" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                            <p>
                                Add Visa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/show_visa/1" class="nav-link">
                            <i class="nav-icon fas fa-share-square"></i>
                            <p> Saved Visa </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/sent_visa/2" class="nav-link">
                            <i class="nav-icon fas fa-certificate"></i>
                            <p> Sent Visa </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="/excutive_finish/6/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Visa Service </p>
                    </a>
                </li>
                   

                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-cog" aria-hidden="true"></i>
                    <p>
                        General Service
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                        <a href="/service/general" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                            <p>
                                Add General Service
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/show_general/1" class="nav-link">
                            <i class="nav-icon fas fa-share-square"></i>
                            <p> Saved General Service </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/sent_gen/2" class="nav-link">
                            <i class="nav-icon fas fa-certificate"></i>
                            <p> Sent General Service </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="/excutive_finish/7/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive General Service </p>
                    </a>
                </li>
                   

                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-hospital" aria-hidden="true"></i>
                    <p>
                        Medical Service
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                        <a href="/service/medical" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle nav-icon" aria-hidden="true"></i>
                            <p>
                                Add Medical Service
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/show_med/1" class="nav-link">
                            <i class="nav-icon fas fa-share-square"></i>
                            <p> Saved Medical Service </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/sent_med/2" class="nav-link">
                            <i class="nav-icon fas fa-certificate"></i>
                            <p> Sent Medical Service </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="/excutive_finish/4/Auth()->user()->id" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p> Archive Medical Service </p>
                    </a>
                </li>
                  

                </ul>
            </li>

        </ul>
        </li>';
        $_GLOBALS['Accountant']='
        <li class="nav-item">
            <a href="/accountant" class="nav-link">
                <i class="nav-icon fas fa-user" aria-hidden="true"></i>
                <p>
                    Accountant
                </p>
            </a>
            </li>
        <li class="nav-item">
            <a  href="/accountant/report" class="nav-link">
                <i class="nav-icon fas fa-user-cog nav-icon"></i>
                <p>accountent report</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/profile" class="nav-link">
                <i class="nav-icon fas fa-user-cog nav-icon"></i>
                <p>profile</p>
            </a>
        </li>';
        @endphp

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if(Auth::user()->hasRole('admin'))
                @php
                echo $_GLOBALS['admin_link'];
                @endphp
                @endif
                @if(Auth::user()->hasRole('sale_manager'))
                @php
                echo $_GLOBALS['Sales_Manager'];
                @endphp
                @endif
                @if(Auth::user()->hasRole('accountant'))
                @php
                echo $_GLOBALS['Accountant'];
                @endphp
                @endif
                @if(Auth::user()->hasRole('sale_executive'))
                @php
                echo $_GLOBALS['Sales_Executive'];
                @endphp
                @endif
                <li class="nav-item">
            <a  href="/change_pass" class="nav-link">
                <i class="nav-icon fa fa-cog nav-icon"></i>
                <p>change password </p>
            </a>
        </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>