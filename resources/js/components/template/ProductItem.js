import React, { Component } from 'react';
import { Link } from "react-router-dom";

export default class ProductItem extends Component {
    render() {
        return (
            <div className="product-item">
                <img src="https://image.freepik.com/free-vector/beautiful-christmas-background-with-christmas-card-template_1361-1770.jpg"/>
                <h3><Link to="/abc" className="nav-link">Resources can be edited with any vector graphic editing software</Link></h3>
                <div className="product_meta">
                    <span className="price"><del>350.000 đ</del></span>
                    <span className="price_sales">300.000 đ</span>
                </div>
                <button class="btn btn-success">Add to Cart</button>
            </div>
        );
    }
}
