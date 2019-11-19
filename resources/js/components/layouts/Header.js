import React, { Component } from 'react';
import { Link } from "react-router-dom";
import axios from 'axios';

import CartItem from '../template/Cart/CartItem';

const BASE_URL = 'http://127.0.0.1:8000';

export default class Header extends Component {
    constructor(props) {
        super(props);
        this.state = {
            products : [],
            cart_items: [],
            is_loaded : false
        };
    }
    remove_cart_item(id){ 
        var cart_item_storage = JSON.parse(localStorage.getItem('cart_items'));
        var position = cart_item_storage.indexOf(id);
        if (position > -1) {
            cart_item_storage.splice(position, 1);
            this.setState({
                cart_items : cart_item_storage
            });  
            localStorage.setItem('cart_items', JSON.stringify(cart_item_storage));
        }
    }
    componentDidMount(){ 
        const $this = this; 
        setTimeout(function(){
            const aProducts = [];
            const carts = JSON.parse(localStorage.getItem('cart_items'));
            if(carts){
                carts.forEach(function(id , i) {
                    axios.get( BASE_URL + '/api/products/' + id)
                    .then(res => {
                        const results = res.data.response; 
                        if(results){  
                            aProducts.push(results);
                            $this.setState({
                                products: aProducts
                            }); 
                        }
                    })
                    .catch(error => console.log(error));
                });
                $this.setState({
                    is_loaded : true
                });
            }
        },500);
    }
    
    render() { 
        return (
            <div className="container">
                <nav className="navbar navbar-expand-lg navbar-light bg-light"> 
                        <Link to="/" className="navbar-brand">Shopping Cart</Link>
                        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span className="navbar-toggler-icon"></span>
                        </button>
                        <div className="collapse navbar-collapse" id="navbarText">
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item"> 
                                <Link to="/" className="nav-link">Home</Link>
                            </li>
                            <li className="nav-item cart_item"> 
                               <Link to="/cart" className="nav-link">Cart</Link>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div className="cart_list">
                    <h4>Giỏ hàng: </h4>
                    <ul>
                        {
                            (this.state.is_loaded == true && this.state.products) ?
                            this.state.products.map((product, i) => 
                                <CartItem
                                    key={i}
                                    data={product}
                                />
                            )
                            : ''
                        }
                    </ul>
                </div>
            </div>
        );
    }
}
