import React, { useState, useEffect , useRef } from "react";
import {Link} from 'react-router-dom'; 
import useForm from 'react-hook-form';
import axios from 'axios';
import { Redirect } from 'react-router-dom';

import CheckoutItem from './template/Checkout/CheckoutItem';
import Message from './template/Product/Message'; 

const BASE_URL = 'http://127.0.0.1:8000';

const Checkout = (props , state) => {    

    const cart_item_storage = JSON.parse(localStorage.getItem('cart_items'));
    if(!cart_item_storage){
        return <Redirect to="/"/>;
    }
    let [total_amount, setCart] = useState(0); 
    // Total amount
    let total = 0;
    let price_default = 0;
    if(cart_item_storage){
        cart_item_storage.map((product, i) =>   
            total += product.price * product.qty
        );
        total_amount = total; 
    }

    const { register , handleSubmit } = useForm();

    let messsage_display = 0; 

    const [toOrderInfo , setToOrderInfo] = useState(false); 

    const [orderId , setDataToOrderId] = useState();
    // Form Validation
    const onSubmit = (values) => { 
        if(values === undefined || values === null){
            return false;
        }

        const data = {
            full_name : values.full_name,
            phone : values.phone,
            address : values.address,
            email : values.email,
            message : values.message,
            county : values.county,
            province : values.province,
            wards : values.wards,
            product : cart_item_storage,
            total_amount : total_amount
        };

        axios.post(BASE_URL + '/api/checkout', data)
        .then(res => {   
            setDataToOrderId(res.data.response.order_id);
            setTimeout(() => setToOrderInfo(true),100);
            
        })
        .catch(error => console.log(error));

        return false; 
    }

    return (

        <div className="container wrap_checkout">  
            { 
                toOrderInfo 
                ? <Redirect to={"/checkout/order-info?order_id=" + orderId }/> 
                : ""  
            }
            <form onSubmit={ handleSubmit(onSubmit) }>
                <div className="row">
                    <div className="col-sm-7 wrap_checkout_cartleft">
                        <div className="from_control">
                            <input 
                                type="text"  
                                className="form-control" 
                                placeholder="Full Name"
                                name="full_name"
                                ref={register}
                                required
                            />
                        </div>
                        <div className="from_control">
                            <input 
                                type="email" 
                                className="form-control" 
                                placeholder="Email"
                                name="email"
                                ref={register}
                                required
                            />
                        </div>
                        <div className="from_control">
                            <input 
                                type="text" 
                                className="form-control" 
                                placeholder="Phone"
                                name="phone"
                                ref={register}
                                required
                            />
                        </div>
                        <div className="from_control">
                            <select 
                                className="form-control"
                                name="province"
                                ref={register}
                            >
                                <option>Province</option>
                                <option>Province 1</option>
                                <option>Province 2</option>
                                <option>Province 3</option>
                                <option>Province 4</option>
                            </select> 
                        </div>
                        <div className="from_control">
                            <select 
                                className="form-control"
                                name="county"
                                ref={register}
                            >
                                <option>County</option>
                                <option>County 1</option>
                                <option>County 2</option>
                                <option>County 3</option> 
                            </select> 
                        </div>
                        <div className="from_control">
                            <select 
                                className="form-control"
                                name="wards"
                                ref={register}
                            >
                                <option>Wards</option>
                                <option>Wards 2</option>
                                <option>Wards 3</option>
                                <option>Wards 4</option>
                            </select> 
                        </div>
                        <div className="from_control">
                            <textarea 
                                className="form-control" 
                                placeholder="Address"
                                name="address"
                                ref={register}
                                required
                            ></textarea>
                        </div>
                        <div className="from_control">
                            <textarea 
                                className="form-control" 
                                placeholder="Message" 
                                rows="10"
                                name="message"
                                ref={register}
                            ></textarea>
                        </div>
                    </div>
                    <div className="col-sm-5 wrap_checkout_cartright">
                        <div className="cart_info">
                            <h4>YOUR ORDER</h4>
                            <table className="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Product
                                        </th> 
                                        <th>
                                            Qty
                                        </th> 
                                        <th width="30%">
                                            Price (VNĐ)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {  
                                        (cart_item_storage) ? (
                                            cart_item_storage.map((product, i) =>  
                                                <CheckoutItem
                                                    key={i} 
                                                    data={product} 
                                                />
                                            )
                                        )
                                        : ''
                                    }
                                    <tr>
                                        <td>
                                            Total
                                        </td>
                                        <td colSpan="2" className="text-center">
                                            { 
                                                new Intl.NumberFormat('de-DE', {  
                                                    minimumFractionDigits: 0, 
                                                    maximumFractionDigits: 0 
                                                }).format(total_amount)
                                            } 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button 
                            className="btn btn-success" 
                            onClick={() => 
                                onSubmit()
                            }
                            >CHECK OUT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    );
};
export default Checkout;