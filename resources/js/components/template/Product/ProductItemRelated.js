import React, { Component } from 'react';
import {Link} from 'react-router-dom';

export default class ProductItemRelated extends Component {
    render() {
        const data = this.props.data;
        const background = { 
            backgroundImage: `url(${data.feature_image})`,
            backgroundSize: 'cover',
            backgroundPosition: 'center center',
        };
        return (
            <div className = "product-item">
                <div className = "thumbnail">
                    <a href = {`/product/${data.product_id}`}  className="nav-link">
                        <span style = { background }></span>
                    </a>
                </div>
                <div className="info">
                    <h3>
                        <a href = {`/product/${data.product_id}`}  className="nav-link">
                            { data.product_name }
                        </a>
                    </h3>
                    <div className = "product_meta"> 
                        <span className="price"> { data.product_price ? data.product_price + ' đ' : '' }</span>
                        <span className="price_sales"> { data.product_price_sales ? data.product_price_sales + ' đ' : '' }</span> 
                    </div>
                    <button className="btn btn-success">Add to Cart</button>
                </div>
            </div>
        );
    }
}
