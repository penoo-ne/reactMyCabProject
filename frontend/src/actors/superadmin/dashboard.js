import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

import 'react-toastify/dist/ReactToastify.css';

const Dashboard = ({ userRole }) => {

  return (





    <div className="content-wrapper">

      <section className="content-header" style={{ 'textAlign': 'left' }}>
        <h1 >
          {userRole.charAt(0).toUpperCase() + userRole.slice(1)}
          <small>dashboard</small>
        </h1>
        <ol className="breadcrumb">
          <li><a href="#"><i className="fa fa-dashboard"></i> Home</a></li>
          <li className="active">Dashboard</li>
        </ol>
      </section>


      <section className="content">

        <div className="row">
          <div className="col-lg-3 col-xs-6" >

            <div className="small-box bg-aqua">
              <div className="inner" style={{ 'textAlign': 'left' }} >
                <h3>150</h3>

                <p>New Rides</p>
              </div>
              <div className="icon">
                <i className="ion ion-android-car"></i>
              </div>
              <a href="#" className="small-box-footer">More info <i className="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div className="col-lg-3 col-xs-6">
            <div className="small-box bg-green">
              <div className="inner" style={{ 'textAlign': 'left' }}>
                <h3>53<sup style={{ 'fontSize': '20px' }}>%</sup></h3>

                <p>Possession</p>
              </div>
              <div className="icon">
                <i className="ion ion-stats-bars"></i>
              </div>
              <a href="#" className="small-box-footer">More info <i className="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div className="col-lg-3 col-xs-6">

            <div className="small-box bg-yellow">
              <div className="inner" style={{ 'textAlign': 'left' }}>
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div className="icon">
                <i className="ion ion-person-add"></i>
              </div>
              <a href="#" className="small-box-footer">More info <i className="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div className="col-lg-3 col-xs-6">
            <div className="small-box bg-red">
              <div className="inner" style={{ 'textAlign': 'left' }}>
                <h3>65</h3>

                <p>New Drivers</p>
              </div>
              <div className="icon">
                <i className="ion ion-pie-graph"></i>
              </div>
              <a href="#" className="small-box-footer">More info <i className="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <div className="row">
          <div className="col-xs-6">
            <div className="box">
              <div className="box-header">
                <h3 className="box-title pull-left"><b>Task Admins</b></h3>
              </div>

              <div className="box-body">
                <table id="example1" className="table table-bordered table-striped" style={{ textAlign: 'left' }}>
                  <thead>
                    <tr>
                      <th>Sr.</th>
                      <th>Name</th>
                      <th>Revenue</th>
                      <th>Details</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Irfan
                      </td>
                      <td>10000.00</td>
                      <td>Win 95+</td>
                    </tr>

                    <tr>
                      <td>2</td>
                      <td>Talha
                      </td>
                      <td>10000.00</td>
                      <td>Win 95+</td>

                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Usama
                      </td>
                      <td>10000.00</td>
                      <td>Win 95+</td>

                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Sabah
                      </td>
                      <td>10000.00</td>
                      <td>Win 95+</td>

                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Sufyan
                      </td>
                      <td>10000.00</td>
                      <td>Win 98+</td>

                    </tr>
                    <tr>
                      <td>6</td>
                      <td>Sadia</td>
                      <td>10000.00</td>
                      <td>Win XP SP2+</td>

                    </tr>
                    <tr>
                      <td>7</td>
                      <td>Sadat</td>
                      <td>10000.00</td>
                      <td>Win XP</td>

                    </tr>
                    <tr>
                      <td>8</td>
                      <td>Naqeeb</td>
                      <td>10000.00</td>
                      <td>Win 98+ / OSX.2+</td>

                    </tr>
                    <tr>
                      <td>9</td>
                      <td>Firefox 1.5</td>
                      <td>10000.00</td>
                      <td>Win 98+ / OSX.2+</td>

                    </tr>
                    <tr>
                      <td>10</td>
                      <td>Firefox 2.0</td>
                      <td>10000.00</td>
                      <td>Win 98+ / OSX.2+</td>

                    </tr>
                    <tr>
                      <td>11</td>
                      <td>Firefox 3.0</td>
                      <td>10000.00</td>
                      <td>Win 2k+ / OSX.3+</td>

                    </tr>
                    <tr>
                      <td>12</td>
                      <td>Camino 1.0</td>
                      <td>10000.00</td>
                      <td>OSX.2+</td>

                    </tr>
                    <tr>
                      <td>13</td>
                      <td>Camino 1.5</td>
                      <td>10000.00</td>
                      <td>OSX.3+</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <div className="col-xs-12">
            <div className="box">
              <div className="box-header">
                <h3 className="box-title pull-left"><b>Team Admin</b></h3>
              </div>


              <div className="box-body">
                <table id="example1" className="table table-bordered table-striped" style={{ textAlign: 'left' }}>
                  <thead>
                    <tr>
                      <th>Sr.</th>
                      <th>Name</th>
                      <th>Revenue</th>
                      <th>Details</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Irfan
                      </td>

                      <td>10000.00</td>

                      <td>Win 95+</td>

                    </tr>



                    <tr>
                      <td>2</td>
                      <td>Talha
                      </td>
                      <td>10000.00</td>
                      <td>Win 95+</td>

                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Usama
                      </td>
                      <td>10000.00</td>
                      <td>Win 95+</td>

                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Sabah
                      </td>
                      <td>10000.00</td>
                      <td>Win 95+</td>

                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Sufyan
                      </td>
                      <td>10000.00</td>
                      <td>Win 98+</td>

                    </tr>
                    <tr>
                      <td>6</td>
                      <td>Sadia</td>
                      <td>10000.00</td>
                      <td>Win XP SP2+</td>

                    </tr>
                    <tr>
                      <td>7</td>
                      <td>Sadat</td>
                      <td>10000.00</td>
                      <td>Win XP</td>

                    </tr>
                    <tr>
                      <td>8</td>
                      <td>Naqeeb</td>
                      <td>10000.00</td>
                      <td>Win 98+ / OSX.2+</td>

                    </tr>
                    <tr>
                      <td>9</td>
                      <td>Firefox 1.5</td>
                      <td>10000.00</td>
                      <td>Win 98+ / OSX.2+</td>

                    </tr>
                    <tr>
                      <td>10</td>
                      <td>Firefox 2.0</td>
                      <td>10000.00</td>
                      <td>Win 98+ / OSX.2+</td>

                    </tr>
                    <tr>
                      <td>11</td>
                      <td>Firefox 3.0</td>
                      <td>10000.00</td>
                      <td>Win 2k+ / OSX.3+</td>

                    </tr>
                    <tr>
                      <td>12</td>
                      <td>Camino 1.0</td>
                      <td>10000.00</td>
                      <td>OSX.2+</td>

                    </tr>
                    <tr>
                      <td>13</td>
                      <td>Camino 1.5</td>
                      <td>10000.00</td>
                      <td>OSX.3+</td>

                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </section>

    </div>
  );
};

export default Dashboard;
