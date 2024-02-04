
import React from 'react';
import './App.css';
import Login from './login';
import Logout from './logout';
import Layout from './layouts/layout';
import { AuthProvider } from './layouts/AuthContext';
import SignUp from './signup';// Import the Login component
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import UpdateUser from "../src/actors/superadmin/UpdateUser";

function App() {
    const isLoggedIn = false;

  return (
      <div className="App">



              <Routes>
                  <Route path="/" element={<Login />} />
                  <Route path="/login" element={<Login />} />
                 
                  <Route path="/layout" element={<Layout />} />
                  <Route path="/addUser" element={<Layout />} />
                  <Route path="/logout" element={<Logout />} />
                  <Route path="/userList" element={<Layout />} />
                  <Route path="/signup" element={<SignUp />} />
                  <Route path="/update-user/:user_id" element={<UpdateUser />} />
                 

              </Routes>



      </div>
  );
}

export default App;
