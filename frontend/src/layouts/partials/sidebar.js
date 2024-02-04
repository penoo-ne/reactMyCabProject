import React, { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

const Sidebar = ({ userRole }) => {
    return (
        
        <aside className="main-sidebar">
       
            <section className="sidebar">
                <div className="user-panel">
                    <div className="pull-left image">
                        <img
                            src="theme/dist/img/user2-160x160.jpg"
                            className="img-circle"
                            alt="User Image"
                        />
                    </div>
                    <div className="pull-left info">
                        <p>Alexander Pierce</p>
                        <i className="fa fa-circle text-success"></i> Online
                        <br />
                    </div>
                </div>

                <form action="#" method="get" className="sidebar-form">
                    <div className="input-group">
                        <input
                            type="text"
                            name="q"
                            className="form-control"
                            placeholder="Search..."
                        />
                        <span className="input-group-btn">
                            <button
                                type="submit"
                                name="search"
                                id="search-btn"
                                className="btn btn-flat"
                            >
                                <i className="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>

                <ul className="sidebar-menu">
                    <li className="header">NAVIGATON</li>
                    
                    {userRole === "Superadmin"  && (
                        <>
                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#" style={{ textAlign: "left" }}>
                                    <i className="fa fa-users"></i>{" "}
                                    <span>Users</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li className="active">
                                        <a href="/addUser">
                                            <i className="fa fa-circle-o"></i>
                                            Add user
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/userList">
                                            <i className="fa fa-circle-o"></i>
                                            Users list
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#">
                                    <i className="fa fa-lock"></i>
                                    <span>Roles & Permissions</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                        {/* <span className="label label-primary pull-right">4</span> */}
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li>
                                        <a href="pages/layout/top-nav.html">
                                            <i className="fa fa-circle-o"></i>
                                            Add role
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/boxed.html">
                                            <i className="fa fa-circle-o"></i>
                                            Role list
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/fixed.html">
                                            <i className="fa fa-circle-o"></i>
                                            Add permission
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/collapsed-sidebar.html">
                                            <i className="fa fa-circle-o"></i>
                                            Permissions list
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </>
                    )}
                    {userRole === "taskadmin" && (
                        <>
                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#" style={{ textAlign: "left" }}>
                                    <i className="fa fa-user"></i>{" "}
                                    <span>Fleets</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li className="active">
                                        <a href="/addUser">
                                            <i className="fa fa-circle-o"></i>
                                            Add fleet
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            fleets list
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#">
                                    <i className="fa fa-car"></i>
                                    <span>Drivers & Assignement</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                        {/* <span className="label label-primary pull-right">4</span> */}
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li>
                                        <a href="pages/layout/top-nav.html">
                                            <i className="fa fa-circle-o"></i>
                                            Add driver
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/boxed.html">
                                            <i className="fa fa-circle-o"></i>
                                            Drivers list
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/fixed.html">
                                            <i className="fa fa-circle-o"></i>
                                            Assign fleet
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/collapsed-sidebar.html">
                                            <i className="fa fa-circle-o"></i>
                                            Assigned fleets
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </>
                    )}
                    {userRole === "teamadmin" && (
                        <>
                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#" style={{ textAlign: "left" }}>
                                    <i className="fa fa-user"></i>{" "}
                                    <span>Attendance</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li className="active">
                                        <a href="/addUser">
                                            <i className="fa fa-circle-o"></i>
                                            Add attendance
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            Attendance list
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#">
                                    <i className="fa fa-bug"></i>
                                    <span> Issues & Accidents</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                        {/* <span className="label label-primary pull-right">4</span> */}
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li>
                                        <a href="pages/layout/top-nav.html">
                                            <i className="fa fa-circle-o"></i>
                                            Add issue
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/boxed.html">
                                            <i className="fa fa-circle-o"></i>
                                            Issues list
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/fixed.html">
                                            <i className="fa fa-circle-o"></i>
                                            Add accident
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/collapsed-sidebar.html">
                                            <i className="fa fa-circle-o"></i>
                                            Accidents list
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </>
                    )}
                    {userRole === "studentsystem_manager" && (
                        <>
                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#" style={{ textAlign: "left" }}>
                                    <i className="fa fa-users"></i>{" "}
                                    <span>Tutors</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li className="active">
                                        <a href="/addUser">
                                            <i className="fa fa-circle-o"></i>
                                            Add new
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            Tutors
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#" style={{ textAlign: "left" }}>
                                    <i className="fa fa-list-alt"></i>{" "}
                                    <span>Categories</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li className="active">
                                        <a href="/addUser">
                                            <i className="fa fa-circle-o"></i>
                                            Add new
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            Categories
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#">
                                    <i className="fa fa-book"></i>
                                    <span> Courses</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                        {/* <span className="label label-primary pull-right">4</span> */}
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li>
                                        <a href="pages/layout/top-nav.html">
                                            <i className="fa fa-circle-o"></i>
                                            Add course
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/boxed.html">
                                            <i className="fa fa-circle-o"></i>
                                            Courses list
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/fixed.html">
                                            <i className="fa fa-circle-o"></i>
                                            Assign tutors
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/collapsed-sidebar.html">
                                            <i className="fa fa-circle-o"></i>
                                            Assigned tutors
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#" style={{ textAlign: "left" }}>
                                    <i className="fa fa-registered"></i>{" "}
                                    <span>Students</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li className="active">
                                        <a href="/addUser">
                                            <i className="fa fa-circle-o"></i>
                                            Enroll new
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            Enrollments
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </>
                    )}

                    {userRole === "accountsadmin" && (
                        <>
                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#" style={{ textAlign: "left" }}>
                                    <i className="fa fa-list-alt"></i>{" "}
                                    <span>Chart of Accounts</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li className="active">
                                        <a href="/addUser">
                                            <i className="fa fa-circle-o"></i>
                                            Add new
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            Chart of Accounts
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#" style={{ textAlign: "left" }}>
                                    <i className="fa fa-arrow-up"></i>{" "}
                                    <span>Sales</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li className="active">
                                        <a href="/addUser">
                                            <i className="fa fa-circle-o"></i>
                                            Add new
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            Sales
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#">
                                    <i className="fa fa-arrow-down"></i>
                                    <span> Expenses</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                        {/* <span className="label label-primary pull-right">4</span> */}
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li>
                                        <a href="pages/layout/top-nav.html">
                                            <i className="fa fa-circle-o"></i>
                                            Add New
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages/layout/boxed.html">
                                            <i className="fa fa-circle-o"></i>
                                            Expenses
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li
                                className="treeview"
                                style={{ textAlign: "left" }}
                            >
                                <a href="#" style={{ textAlign: "left" }}>
                                    <i className="fa fa-file"></i>{" "}
                                    <span>Reports</span>
                                    <span className="pull-right-container">
                                        <i
                                            className="fa fa-angle-left pull-right"
                                            style={{ paddingRight: "20px" }}
                                        ></i>
                                    </span>
                                </a>
                                <ul className="treeview-menu">
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            Sales
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            Expenses
                                        </a>
                                    </li>
                                    <li className="active">
                                        <a href="/addUser">
                                            <i className="fa fa-circle-o"></i>
                                            Profit and Loss
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            Trial Balance
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i className="fa fa-circle-o"></i>
                                            Cash flow statement
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </>
                    )}
                    {/*  <li>
                        <a href="pages/widgets.html">
            <i className="fa fa-th"></i> <span>Widgets</span>
            <span className="pull-right-container">
              <small className="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
       <li className="treeview" style={{ textAlign:'left'}}>
          <a href="#">
            <i className="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span className="pull-right-container">
              <i className="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul className="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i className="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="pages/charts/morris.html"><i className="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="pages/charts/flot.html"><i className="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="pages/charts/inline.html"><i className="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
       <li className="treeview" style={{ textAlign:'left'}}>
          <a href="#">
            <i className="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span className="pull-right-container">
              <i className="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul className="treeview-menu">
            <li><a href="pages/UI/general.html"><i className="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i className="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i className="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i className="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i className="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i className="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>
       <li className="treeview" style={{ textAlign:'left'}}>
          <a href="#">
            <i className="fa fa-edit"></i> <span>Forms</span>
            <span className="pull-right-container">
              <i className="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul className="treeview-menu">
            <li><a href="pages/forms/general.html"><i className="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="pages/forms/advanced.html"><i className="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="pages/forms/editors.html"><i className="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
       <li className="treeview" style={{ textAlign:'left'}}>
          <a href="#">
            <i className="fa fa-table"></i> <span>Tables</span>
            <span className="pull-right-container">
              <i className="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul className="treeview-menu">
            <li><a href="pages/tables/simple.html"><i className="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="pages/tables/data.html"><i className="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/calendar.html">
            <i className="fa fa-calendar"></i> <span>Calendar</span>
            <span className="pull-right-container">
              <small className="label pull-right bg-red">3</small>
              <small className="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i className="fa fa-envelope"></i> <span>Mailbox</span>
            <span className="pull-right-container">
              <small className="label pull-right bg-yellow">12</small>
              <small className="label pull-right bg-green">16</small>
              <small className="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
       <li className="treeview" style={{ textAlign:'left'}}>
          <a href="#">
            <i className="fa fa-folder"></i> <span>Examples</span>
            <span className="pull-right-container">
              <i className="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul className="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i className="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="pages/examples/profile.html"><i className="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i className="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i className="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i className="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i className="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i className="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i className="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i className="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
       <li className="treeview" style={{ textAlign:'left'}}>
          <a href="#">
            <i className="fa fa-share"></i> <span>Multilevel</span>
            <span className="pull-right-container">
              <i className="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul className="treeview-menu">
            <li><a href="#"><i className="fa fa-circle-o"></i> Level One</a></li>
           <li className="treeview" style={{ textAlign:'left'}}>
              <a href="#"><i className="fa fa-circle-o"></i> Level One
                <span className="pull-right-container">
                  <i className="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul className="treeview-menu">
                <li><a href="#"><i className="fa fa-circle-o"></i> Level Two</a></li>
               <li className="treeview" style={{ textAlign:'left'}}>
                  <a href="#"><i className="fa fa-circle-o"></i> Level Two
                    <span className="pull-right-container">
                      <i className="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul className="treeview-menu">
                    <li><a href="#"><i className="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i className="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i className="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
    {/* <li><a href="https://adminlte.io/docs"><i className="fa fa-book"></i> <span>Documentation</span></a></li>
        <li className="header">LABELS</li>
        <li><a href="#"><i className="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i className="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i className="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> */}
     
                </ul>
            </section>
        </aside>
    );
};

export default Sidebar;
