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
    
    componentDidMount(){ 
        const $this = this;   
        const carts = JSON.parse(localStorage.getItem('cart_items'));
        if(carts){ 
            $this.setState({
                products: carts
            });
            $this.setState({
                is_loaded : true
            });
        } 
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
                            <li className="nav-item cart_item"> 
                               <Link to="/cart" className="nav-link">Cart</Link>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        );
    }
}
