import React, { Component , useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { Link } from "react-router-dom";

import ThumbnailItem from './template/Product/ThumbnailItem';
import RelateProduct from './template/Product/RelateProduct';
import Message from './template/Product/Message';

const BASE_URL = 'http://127.0.0.1:8000';
 
export default class ProductDetail extends Component {
    constructor(props) {
        super(props); 
        this.state = {
            is_loading: 0,
            title:'',
            img:'',
            gallery: [],
            desc:'',
            id:'', 
            price:'',
            price_sales:'',
            category_id : 0,
            cart_items : [],
            message_status:'',
            qty: 1
        };
    }

    updateQty(val){
        this.setState({
            qty : val
        });
    }

    addToCart(id , title , price , image){  
        const cart_item_storage = JSON.parse(localStorage.getItem('cart_items')) ? JSON.parse(localStorage.getItem('cart_items')) : [];
        const object_item = {
            id : id,
            title : title,
            price : price,
            qty : this.state.qty,
            image : image
        };

        if(typeof cart_item_storage != "undefined"  && cart_item_storage != null && cart_item_storage.length != null && cart_item_storage.length > 0 ) {
            let cart_exists = 0;  
            let state_qty = this.state.qty;
            cart_item_storage.map(function(e,i) {
                if(object_item.id === e.id){
                    e.qty = parseInt(e.qty) + parseInt(state_qty);
                    cart_exists = 1;
                }
            });

            if(cart_exists === 0){
                cart_item_storage.push(object_item);
                cart_exists = 0;
            }
            
            localStorage.setItem('cart_items', JSON.stringify(cart_item_storage));  
            this.setState({
                cart_items : cart_item_storage,
                message_status : 'Sản phẩm đã được thêm vào giỏ hàng' 
            }); 
        }else{
            cart_item_storage.push(object_item); 
            localStorage.setItem('cart_items', JSON.stringify(cart_item_storage));
            this.setState({
                cart_items : cart_item_storage,
                message_status : 'Sản phẩm đã được thêm vào giỏ hàng' 
            }); 
        } 
    }
    
    componentDidMount(){
        const _id = this.props.match.params.id;
        axios.get( BASE_URL + '/api/products/'+_id)
        .then(res => {
            const data = res.data.response; 
            this.setState({ 
                title: data.product_name,
                img: data.feature_image,
                gallery: data.gallery,
                desc: data.product_description,
                short_desc: data.product_short_description,
                id: data.product_id, 
                price: data.product_price,
                price_sales: data.product_price_sales,
                category_id : data.category_id,
                is_loading: 1
            });
        })
        .catch(error => console.log(error));
    }

    render() {  
        const data = this.state; 
        return (
            <div className="container wrap_product_single">
                {
                    data.message_status 
                    ? <Message message_status= {data.message_status} />
                    : ''
                }
                
                <div className="wrap_product">
                    <div className="row">
                        <div className="col-sm-6">
                            <div className="thumbnail">
                                <img src= {data.img}/>
                            </div>
                            <div className="gallery">
                                { 
                                    data.gallery 
                                    ? data.gallery.map((img, i) => 
                                        <ThumbnailItem key={i} data={img} /> 
                                    ) 
                                    : '' 
                                }
                            </div>
                        </div>
                        <div className="col-sm-6">
                            <h1> { data.title } </h1>
                            <p className="price">
                                <span className="price_normal">
                                    { data.price ? data.price + ' đ' : '' }  
                                </span>
                                <span className="price_sales">
                                    { data.price_sales ? data.price_sales + ' đ' : '' }
                                </span>
                            </p>
                            <div className="desc">
                                { data.short_desc }
                            </div>
                            <div className="meta_info">
                                <Link to="/">#Example </Link>
                            </div>
                            <div className="qty">
                               <input 
                                    id="product_qty"
                                    className="form-control" 
                                    value= {this.state.qty}
                                    name="qty"
                                    onChange={e => this.updateQty(e.target.value)}
                                />
                            </div>
                            <button 
                                className="btn btn-success btn_buy_now" 
                                onClick={() => 
                                    this.addToCart(data.id , data.title , data.price_sales , data.img)
                                }
                            >
                                Add to Cart
                            </button>
                        </div>
                    </div> 
                </div>
                <div className="wrap_product">
                    <h2>Description</h2>
                    <div className="wrap_product_description">
                        { data.desc }
                    </div>
                </div>

                <div className="wrap_product">
                    <h2>Related Products</h2>
                    { data.is_loading == 1 ? <RelateProduct id={ data.id }/> : '' }
                </div>
            </div>
        );
    }
}
