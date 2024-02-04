import React, { lazy, Suspense} from "react";
import Header from "./partials/header";
import Sidebar from "./partials/sidebar";
import Footer from "./partials/footer";
import NF from "./notfound";
import { useAuth } from './AuthContext';


// import { BrowserRouter as Router, Routes, Route } from "react-router-dom";


const Dashboard = () => {
    const { isLoggedIn, userRole } = useAuth();
    const role = localStorage.getItem('userRole');


    // Checking if location and location.state are defined
    if (role.length < 1) {
        // Handle the case when location or state is undefined
        return <NF />;
    }
    var path = window.location.pathname;

// Extract the 'addUser' parameter from the path
var path = path.split('/').pop();
let UserRoleDashboard;
    // Destructuring userRole from location.state.data
    // const { userRole, page } = location.state.data;
if(path.length > 1 && path !== 'layout'){
    UserRoleDashboard = lazy(() => import(`../actors/${role.toLowerCase()}/${path}`));

}else if(path.length == 0 || path === 'layout')
{
    UserRoleDashboard = lazy(() => import(`../actors/${role.toLowerCase()}/dashboard`));
}
    // const hasRoute = location.pathname !== '/layout';
    // Dynamically import the component based on the page attribute
    // const UserRoleDashboard = lazy(() => import(`../actors/${userRole.toLowerCase()}${page}`));
    return (

        <Suspense fallback={<div>Loading...</div>}>
            <Header />
            <Sidebar userRole={userRole} />
            <div className="wrapper">
            <UserRoleDashboard userRole={userRole} />
            <Footer />
            </div>
        </Suspense>
    );
};
export default Dashboard;
   