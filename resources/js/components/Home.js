import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ProductItem from './Template/Product/ProductItem';
import Slider from './Sliders';
import axios from 'axios';
import {Link} from 'react-router-dom';
import { connect } from "react-redux";
import { actFetchProductsRequest } from '../actions/index';
const BASE_URL = 'http://127.0.0.1:8000';

class Home extends Component {

    componentDidMount(){
        this.props.fetchAllProducts();
    }

    render() { 
        const { products } = this.props.products; 
        return (
            <div className="container">
                <Slider/>
                <div className="row justify-content-center">
                    <h2>SẢN PHẨM MỚI</h2>
                    <div className="products">
                        {
                            products ? 
                            products.map((product, i) => 
                                <ProductItem
                                    key={i}
                                    data={product}
                                />
                            )
                            : ''
                        }
                    </div>
                </div>
                <div className="row justify-content-center">
                    <h2>SẢN PHẨM NỔI BẬT</h2>
                    <div className="products">
                        {
                            products ? 
                            products.map((product, i) => 
                                <ProductItem
                                    key={i}
                                    data={product}
                                />
                            )
                            : ''
                        }
                    </div>
                </div>
                <div className="row justify-content-center">
                    <h2>SẢN PHẨM ĐÃ XEM</h2>
                    <div className="products">
                        {
                            products ? 
                            products.map((product, i) => 
                                <ProductItem
                                    key={i}
                                    data={product}
                                />
                            )
                            : ''
                        }
                    </div>
                </div>
            </div>
        );
    }
}

const mapStateToProps = state => {
    return {
        products: state.products
    }
}

const mapDispatchToProps = (dispatch, props) => {
    return {
        fetchAllProducts : () => {
            dispatch(actFetchProductsRequest());
        }
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Home);
