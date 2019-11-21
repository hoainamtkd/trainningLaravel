import React, { useState, useEffect , useRef } from "react";
import {Link} from 'react-router-dom';
import CartItem from "./template/Cart/CartItem";

const Cart = (props) => {    
    // delete cart by id
    const [id , deleteCart] = useState(0);

    const cart_item_storage = JSON.parse(localStorage.getItem('cart_items'));
    
    let [total_amount, setCart] = useState(0); 
    useEffect(() => { 
        if(id !== 0){
            const cart_item_storage = JSON.parse(localStorage.getItem('cart_items'));
            let position = -1;
            cart_item_storage.map(function(e,i) {
                if(id === e.id){
                    e.qty++;
                    position = i;
                }
            });
            if (position > -1) {
                cart_item_storage.splice(position, 1);
                localStorage.setItem('cart_items', JSON.stringify(cart_item_storage));
                removeElementsByClass('cart_item_' + id);
            }
        }
    });

    let total = 0;
    function updateCart(val){ 
        let position_item = val.item_number - 1;
        cart_item_storage[position_item]['qty'];
        localStorage.setItem('cart_items', JSON.stringify(cart_item_storage)); 
        if(cart_item_storage){
            cart_item_storage.map((product, i) =>   
                total += product.price * product.qty
            );
        }
        setCart(total); 
    }

    // Total amount
    let price_default = 0;
    if(cart_item_storage){
        cart_item_storage.map((product, i) =>   
            total += product.price * product.qty
        );
        total_amount = total; 
    }

    return (
        <div className="container wrap_cart_list">
            <table className="table table-bordered">
                <thead>
                    <tr>
                        <th width="3%">STT</th>
                        <th width="10%">Image</th>
                        <th width="40%">Product Name</th>
                        <th width="3%">Qty</th>
                        <th width="15%">Price (VNĐ)</th>
                        <th width="15%">Total (VNĐ)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {  
                        (cart_item_storage.length > 0) ? (
                            cart_item_storage.map((product, i) =>  
                                <CartItem
                                    key={i}
                                    item_number = {i + 1}
                                    data={product}
                                    updateQty={ updateCart }
                                    updateCart={ updateCart }
                                />
                            )
                        )
                        : <td colSpan="7">Cart empty</td>
                    }
                </tbody>
            </table>
            <div className="total_cart"> 
                <table className="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="40%">Total Purchases: </td>
                            <td className="total_amount">
                                { 
                                    new Intl.NumberFormat('de-DE', {  
                                        minimumFractionDigits: 0, 
                                        maximumFractionDigits: 0 
                                    }).format(total_amount)
                                } VNĐ
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Link to="/checkout" className="btn-checkout btn btn-success">
                    Checkout
                </Link>
            </div>
        </div>
    );
};
export default Cart;