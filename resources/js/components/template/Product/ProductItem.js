import React, { Component } from 'react';
import {Link} from 'react-router-dom';

export default class ProductItem extends Component {
    constructor(props) {
        super(props);
    }

    addToCart(id){ 
        var cart_item_storage = JSON.parse(localStorage.getItem('cart_items'));
        if(cart_item_storage){
            if(cart_item_storage.indexOf(id) == -1){
                cart_item_storage.push(id);
                this.setState({
                    cart_items : cart_item_storage
                });  
                localStorage.setItem('cart_items', JSON.stringify(cart_item_storage));
            }
        }
    }

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
                        <span style = { background } ></span>
                    </a>
                </div>
                <div className="info">
                    <h3>
                        <a href={`/product/${data.product_id}`}  className="nav-link">
                            { data.product_name }
                        </a>
                    </h3>
                    <div className = "product_meta"> 
                        <span className="price"> { data.product_price ? data.product_price + ' đ' : '' }</span>
                        <span className="price_sales"> { data.product_price_sales ? data.product_price_sales + ' đ' : '' }</span> 
                    </div>
                    <a href={`/product/${data.product_id}`} className="btn btn-success">BUY NOW</a>
                </div>
            </div>
        );
    }
}
