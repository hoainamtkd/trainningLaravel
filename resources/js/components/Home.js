import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ProductItem from './Template/Product/ProductItem';
import Slider from './Sliders';
import axios from 'axios';
import {Link} from 'react-router-dom';
import { connect } from "react-redux";
import { actFetchProductsRequest , actFetchSlider } from '../actions/index';
const BASE_URL = 'http://127.0.0.1:8000';

class Home extends Component {

    componentDidMount(){
        this.props.fetchAllProducts();
    }
    componentWillMount(){
        this.props.getSliderOnHome();
    }

    render() {  
        const { products } = this.props.products; 
        const { main_slider } = this.props.slider;
        const { aside_slider } = this.props.slider;

        return (
            <div className="container">
                <Slider 
                    main_slider = { main_slider }
                    aside_slider= { aside_slider }
                />
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
            </div>
        );
    }
}

const mapStateToProps = state => { 
    return {
        products: state.products,
        slider: state.slider
    }
}

const mapDispatchToProps = (dispatch, props) => {
    return {
        fetchAllProducts : () => {
            dispatch(actFetchProductsRequest());
        },
        getSliderOnHome : () => {
            dispatch(actFetchSlider());
        }
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Home);
