import React, { useState, useEffect , useRef } from "react";
import {Link} from 'react-router-dom'; 

const Checkout = (props) => {   
    return (
        <div className="container wrap_checkout">
            <div class="row">
                <div className="col-sm-7 wrap_checkout_cartleft">
                    <div className="from_control">
                        <input type="text" className="form-control" placeholder="Full Name"/>
                    </div>
                    <div className="from_control">
                        <input type="text" className="form-control" placeholder="Email"/>
                    </div>
                    <div className="from_control">
                        <input type="text" className="form-control" placeholder="Phone"/>
                    </div>
                    <div className="from_control">
                        <select class="form-control">
                            <option>Province</option>
                            <option>Province 1</option>
                            <option>Province 2</option>
                            <option>Province 3</option>
                            <option>Province 4</option>
                        </select> 
                    </div>
                    <div className="from_control">
                        <select class="form-control">
                            <option>County</option>
                            <option>County 1</option>
                            <option>County 2</option>
                            <option>County 3</option> 
                        </select> 
                    </div>
                    <div className="from_control">
                        <select class="form-control">
                            <option>Wards</option>
                            <option>Wards 2</option>
                            <option>Wards 3</option>
                            <option>Wards 4</option>
                        </select> 
                    </div>
                    <div className="from_control">
                        <textarea className="form-control" placeholder="Address"></textarea>
                    </div>
                    <div className="from_control">
                        <textarea className="form-control" placeholder="Message" rows="10"></textarea>
                    </div>
                </div>
                <div className="col-sm-5 wrap_checkout_cartright">
                    <div class="cart_info">
                        <h4>YOUR ORDER</h4>
                        <table className="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        Product
                                    </th>
                                    <th width="40%">
                                        Total (VNĐ)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        AAA
                                    </td>
                                    <td>
                                        AAA
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Total
                                    </td>
                                    <td>
                                        5.000.000
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-success">CHECK OUT</button>
                    </div>
                </div>
            </div>
        </div>
    );
};
export default Checkout;