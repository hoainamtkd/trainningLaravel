import React, { useState, useEffect , useRef } from "react";
import {Link} from 'react-router-dom'; 
import useForm from 'react-hook-form';
import axios from 'axios';
import { Redirect , useParams } from 'react-router-dom';
import queryString from 'query-string';

import CheckoutItem from './template/Checkout/CheckoutItem';
const BASE_URL = 'http://127.0.0.1:8000';

const InfoOrder = (props) => {   
    const queryString = require('query-string');
    const orderId = queryString.parse(location.search).order_id;
    const [data , dataSet] = useState({ data:[] });
    let [is_loaded,setLoading] = useState(false);
    useEffect(() => {
        (async function() {
            try {
                axios.get( BASE_URL + '/api/order/' + orderId)
                .then(results => { 
                    const res = results.data.response;
                    dataSet(res);
                    setLoading( true );
                })
                .catch(error => console.log(error));
            } catch (e) {
                console.error(e);
            }
            
        })();
        // Remove cart
        localStorage.removeItem("cart_items");
    }, []);  

    let address = [];
    let product = [];
    let total_amount = 0;
    let total = 0;
    if(is_loaded == true) { 
        address = JSON.parse(data.address); 
        product = JSON.parse(data.product); 
        product.map((data, i) =>   
            total += data.price * data.qty
        );
        total_amount = total;  
    }

    return (
        <div className="container wrap_checkout_info"> 
            <p>Your order has been successfully placed. We will contact you as soon as possible</p>
            <br/>
            <h3>Order: #{data.order_id}</h3>
            <table className="table table-bordered">
                <tbody>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                     {
                        product.map((product, i) => 
                            <CheckoutItem
                                key={i}
                                data={product}
                            />
                        )
                    }
                    <tr>
                        <td>
                            Total
                        </td>
                        <td colSpan="2" className="total text-center">
                            { 
                                new Intl.NumberFormat('de-DE', {  
                                    minimumFractionDigits: 0, 
                                    maximumFractionDigits: 0 
                                }).format(total_amount) + ' đ'
                            } 
                        </td>
                    </tr>
                </tbody>
            </table>
            <br/>
            <h3>Additional Infomation</h3>
            <div className="additional_infomation">
                <p>{ data.message }</p>
            </div>

            <br/>
            <h3>Customer Details</h3>
            <table className="table table-bordered"> 
                <tbody> 
                    <tr>
                        <td width="10%" className="text-center">Phone</td>
                        <td>{ data.phone }</td> 
                    </tr>
                    <tr> 
                        <td  className="text-center">Email</td>
                        <td>{ data.email }</td>
                    </tr>
                </tbody>
            </table>

            <br/>
            <h3>Billing Address</h3>
            <div className="additional_infomation">
                <table className="table table-bordered"> 
                    <tbody> 
                        <tr>
                            <td width="10%" className="text-center">Full Name</td>
                            <td>{ data.name }</td> 
                        </tr>
                        <tr> 
                            <td className="text-center">Address</td>
                            <td>{ (is_loaded == true) ? address.address : '' }</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br/>
            <h3>Shipping Address</h3>
            <div className="additional_infomation">
                <table className="table table-bordered">
                    <tbody> 
                        <tr>
                            <td width="10%" className="text-center">Full Name</td>
                            <td>{ data.name }</td> 
                        </tr>
                        <tr> 
                            <td className="text-center">Address</td>
                            <td> 
                                { (is_loaded == true) ? address.address : '' }
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    );
};
export default InfoOrder;