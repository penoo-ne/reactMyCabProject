import React, { useEffect, useState } from "react";
// import { link } from "react-router-dom";
import axios from "axios";
import { json } from "react-router-dom";
// import { Redirect } from "react-router-dom";
import { useNavigate, useParams } from "react-router-dom";



const UpdateUser = () => {
    const { user_id } = useParams(); // Retrieve userId from URL params
    const navigate = useNavigate();
    // const [userData, setUserData] = useState(null);
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [status, setStatus] = useState("");
    const [role_id, setRole] = useState("");
    const [image, setImage] = useState(null);
    const [franchise_id, setFranchise] = useState("");
    const [is_franchise_owner, setIs_franchise_owner] = useState("");
    const [error, setError] = useState("");
    // const [redirectToList, setRedirectToList] = useState(false);


    // const setTokenInLocalStorage = (token) => {
    //     localStorage.setItem("token", token);
    // };

    useEffect(() => {
        // Fetch user data and populate form fields
        const fetchUser = async () => {
            try {
                const response = await axios.get(
                    `http://127.0.0.1:8000/api/users/${user_id}/edit`
                );
                const userData = response.data.data; // assuming response.data is an object with user data
                // assuming response.data is an object with user data
                console.log("User Data:", userData);
                setName(userData.name);
                setEmail(userData.email);
                setStatus(userData.status === '1' ? 'active' : 'inactive');
                console.log("Status:", status);
                setRole(userData.role_id);
                setFranchise(userData.franchise_id);
                setIs_franchise_owner(userData.is_franchise_owner === '1' ? 'franchise_owner' : 'customer');
                // Assuming image data is handled separately



            } catch (error) {
                setError(
                    error.response ? error.response.data.error : error.message
                );
            }
        };

        fetchUser();
    }, [user_id]);

    const handleUpdate = async (e) => {
        e.preventDefault();
        try {
            const formData = new FormData();
            formData.append("name", name);
            formData.append("email", email);
            formData.append("status", status ? "active" : "inactive");
            // console.log("Status:", status ? "active" : "inactive");

            formData.append("role_id", role_id);
            formData.append("franchise_id", franchise_id);
            formData.append("is_franchise_owner", is_franchise_owner ? "franchise_owner" : "customer");

            formData.append("image", image);
            console.log('image')
            const token = localStorage.getItem("token"); // Retrieve token from localStorage

            const response = await axios.post(
                `http://127.0.0.1:8000/api/edit-new-user/${user_id}`,
                formData,
                {
                    headers: {
                        Authorization: `Bearer ${token}` // Include token in request headers
                    }
                }
            );

            // Handle response
            navigate("/userList");
        } catch (error) {
            setError(
                error.response ? error.response.data.error : error.message
            );
        }
    };

    return (

        <div className="content-wrapper" >
            <section className="content-header" style={{ textAlign: "left" }}>
                <h1>
                    {"Superadmin"}
                    <small>dashboard</small>
                </h1>
                <ol className="breadcrumb">
                    <li>
                        <a href="#">
                            <i className="fa fa-dashboard"></i> Home
                        </a>
                    </li>
                    <li className="active">Dashboard</li>
                </ol>
            </section>
            <hr style={{ border: "1px solid #e3e3e3", margin: "10px" }} />
            <section className="content" style={{ minHeight: '100vh' }}>
                <div className="row">
                    <div className="col-md-12 col-xm-12">
                        <div className="box  box-primary text-left">
                            <div className="box-header with-border" >
                                <h3 className="box-title">Edit user</h3>
                            </div>

                            <form onSubmit={handleUpdate}>
                                <div className="box-body">
                                    <div className="form-group has-feedback col-md-6 col-xm-12">
                                        <label for="exampleInputName">
                                            Name
                                        </label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Name"
                                            value={name}
                                            onChange={(e) =>
                                                setName(e.target.value)
                                            }
                                            autoComplete="off"

                                        />
                                        {/* <span className="glyphicon glyphicon-envelope form-control-feedback"></span> */}
                                    </div>

                                    <div className="form-group has-feedback col-md-6 col-xm-12">
                                        <label for="exampleInputEmail1">
                                            Email / Username
                                        </label>
                                        <input
                                            type="email"
                                            className="form-control"
                                            placeholder="Email"
                                            value={email}
                                            onChange={(e) =>
                                                setEmail(e.target.value)
                                            }
                                            autoComplete="off"
                                        />
                                    </div>




                                    <div className="form-group has-feedback col-md-6 col-xm-12">
                                        <label for="exampleInputEmail1">
                                            Status
                                        </label>
                                        <select
                                            className="form-control"
                                            value={status ? '1' : '0'}
                                            onChange={(e) => setStatus(e.target.value === status)}
                                        // setStatus(e.target.value)

                                        >
                                            <option value="">
                                                {" "}
                                                Select status
                                            </option>
                                            <option value='1'>
                                                {" "}
                                                active
                                            </option>
                                            <option value='0'>
                                                {" "}
                                                inactive
                                            </option>
                                        </select>
                                        {/* <span className="glyphicon glyphicon-lock form-control-feedback"></span> */}
                                    </div>

                                    <div className="form-group has-feedback col-md-6 col-xm-12">
                                        <label for="exampleInputEmail1">
                                            User role
                                        </label>
                                        <select
                                            className="form-control"
                                            value={role_id}
                                            onChange={(e) =>
                                                setRole(e.target.value)
                                            }

                                        >
                                            <option value="">
                                                {" "}
                                                Select role
                                            </option>
                                            <option value="17">
                                                {" "}
                                                Task Admin
                                            </option>

                                            <option value="5">
                                                {" "}
                                                Team Admin
                                            </option>

                                            <option value="18">
                                                {" "}
                                                Customer
                                            </option>
                                            <option value="19">
                                                {" "}
                                                Franchiseowner
                                            </option>
                                            <option value="20">
                                                {" "}
                                                Student Manager
                                            </option>
                                            <option value="21">
                                                {" "}
                                                Accountant
                                            </option>
                                            <option value="22">
                                                {" "}
                                                CustomerAdmin
                                            </option>
                                        </select>
                                        {/* <span className="glyphicon glyphicon-lock form-control-feedback"></span> */}
                                    </div>

                                    <div className="form-group has-feedback col-md-6 col-xm-12">
                                        <label for="exampleInputEmail1">
                                            Franchise
                                        </label>
                                        <select
                                            className="form-control"
                                            value={franchise_id}
                                            onChange={(e) =>
                                                setFranchise(e.target.value)
                                            }

                                        >
                                            <option value="">
                                                {" "}
                                                Select
                                            </option>
                                            <option value="1">
                                                {" "}
                                                test
                                            </option>
                                            <option value="2">
                                                {" "}
                                                test1
                                            </option>
                                            <option value="3">
                                                {" "}
                                                test2
                                            </option>
                                        </select>
                                        {/* <span className="glyphicon glyphicon-lock form-control-feedback"></span> */}
                                    </div>


                                    <div className="form-group has-feedback col-md-6 col-xm-12">
                                        <label for="exampleInputEmail1">
                                            Franchise owner
                                        </label>
                                        <select
                                            className="form-control"
                                            value={is_franchise_owner ? '1' : '0'}
                                            onChange={(e) =>
                                                setIs_franchise_owner(e.target.value === is_franchise_owner)
                                            }

                                        >
                                            <option value="">
                                                {" "}
                                                Select
                                            </option>
                                            <option value="1">
                                                {" "}
                                                franchise_owner
                                            </option>
                                            <option value="0">
                                                {" "}
                                                customer
                                            </option>
                                        </select>
                                        {/* <span className="glyphicon glyphicon-lock form-control-feedback"></span> */}
                                    </div>






                                    <div className="form-group has-feedback col-md-6 col-xm-12">
                                        <label for="exampleInputFile">
                                            User Image
                                        </label>
                                        <input
                                            type="file"
                                            className="form-control"
                                            placeholder="Image"
                                            onChange={(e) => setImage(e.target.files[0])}  // Update to handle file selection
                                            accept=".jpg,.jpeg,.png,.gif" // Limit accepted file types to images
                                        />
                                    </div>


                                </div>

                                <div className="box-footer text-right">
                                    <button
                                        type="submit"
                                        className="btn btn-primary"

                                    >
                                        Edit user
                                    </button>
                                </div>
                            </form>
                        </div>
                        {error && (
                            <p style={{ color: "red", background: "pink" }}>
                                {error}
                            </p>
                        )}
                    </div>
                </div>
            </section>
        </div>
    );
};

export default UpdateUser;