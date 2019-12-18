import React, { Component , useState } from 'react';
import { Link } from "react-router-dom";
import { connect } from "react-redux";
import { actGetProductRequest , actUpdateAmount , actFetchProductRelative } from '../actions/index';


import ThumbnailItem from './template/Product/ThumbnailItem';
import RelateProduct from './template/Product/RelateProduct';
import Message from './template/Product/Message';

const BASE_URL = 'http://127.0.0.1:8000';

let is_loaded = 0;
let message_status = '';
class ProductDetail extends Component {

    componentDidMount(){
        var { match } = this.props;
        if (match) {
            var id = match.params.id;
            this.props.getProductbyID(id);
        }  
        is_loaded = 1; 
    }

    onUpdateAmount(val){
        let product = this.props.product.product;
        this.props.UpdateAmount(val,product);
    }

    render() {  
        const data = is_loaded == 1 ? this.props.product.product : '';
        console.log(this.props);
        return (
            <div className="container wrap_product_single">
                {
                    message_status 
                    ? <Message message_status= {message_status} />
                    : ''
                }
                <div className="wrap_product">
                    <div className="row">
                        <div className="col-sm-6">
                            <div className="thumbnail">
                                <img src= {data.feature_image}/>
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
                            <h1> { data.product_name } </h1>
                            <p className="price">
                                <span className="price_normal">
                                    { data.product_price ? data.product_price + ' đ' : '' }  
                                </span>
                                <span className="price_sales">
                                    { data.product_price_sales ? data.product_price_sales + ' đ' : '' }
                                </span>
                            </p>
                            <div className="desc">
                                { data.product_short_description }
                            </div>
                            <div className="meta_info">
                                <Link to="/">#Example </Link>
                            </div>
                            <div className="qty">
                               <input 
                                    id="product_qty"
                                    className="form-control" 
                                    value= {data.qty ? data.qty : 1}
                                    name="qty"
                                    onChange={e => this.onUpdateAmount(e.target.value)}
                                />
                            </div>
                            <button 
                                className="btn btn-success btn_buy_now" 
                                onClick={() => 
                                    this.actAddtoCart(
                                        data.product_id ,  
                                        data.product_name , 
                                        data.product_price_sales , 
                                        data.qty ? data.qty : 1 ,
                                        data.feature_image,
                                    )
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
                        { data.product_description }
                    </div>
                </div>

                <div className="wrap_product">
                    <h2>Related Products</h2>
                    { is_loaded == 1 ? <RelateProduct id={ data.product_id }/> : '' }
                </div>
            </div>
        );
    }

    actAddtoCart(id , title , price ,qty , image){ 
        const aCartItemStorage = JSON.parse(localStorage.getItem('cart_items')) 
        ? JSON.parse(localStorage.getItem('cart_items')) 
        : [];
        const object_item = {
            id : id,
            title : title,
            price : price,
            qty : qty,
            image : image
        }; 
        if(
            typeof aCartItemStorage != "undefined"  
            && aCartItemStorage != null 
            && aCartItemStorage.length != null 
            && aCartItemStorage.length > 0 
        ) {
            let cart_exists = 0;  
            let state_qty = qty;
            aCartItemStorage.map(function(e,i) {
                if(object_item.id === e.id){
                    e.qty = parseInt(e.qty) + parseInt(state_qty);
                    cart_exists = 1;
                }
            });

            if(cart_exists === 0){
                aCartItemStorage.push(object_item);
                cart_exists = 0;
            }
            
            localStorage.setItem('cart_items', JSON.stringify(aCartItemStorage));  
            message_status = 'Sản phẩm đã được thêm vào giỏ hàng';
            this.setState({
                cart_items : aCartItemStorage
            }); 
        }else{
            aCartItemStorage.push(object_item); 
            localStorage.setItem('cart_items', JSON.stringify(aCartItemStorage));
            this.setState({
                cart_items : aCartItemStorage
            }); 
            message_status = 'Sản phẩm đã được thêm vào giỏ hàng' ;
        } 
    }
}

const mapStateToProps = state => {  
    return {
        product: state.products,
        product_relative: state.product_relative
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        getProductbyID : (id) => {
            dispatch(actGetProductRequest(id));
        },
        UpdateAmount : (val,product) => {
            dispatch(actUpdateAmount(val,product));
        },
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ProductDetail);
