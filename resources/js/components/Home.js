import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ProductItem from './Template/Product/ProductItem';
import axios from 'axios';
import {Link} from 'react-router-dom';

const BASE_URL = 'http://127.0.0.1:8000';

export default class Home extends Component {
    constructor(props) {
        super(props);
        this.state = {
            products : []
        };
    }
    componentDidMount(){
        axios.get( BASE_URL + '/api/products')
        .then(res => {
            const results = res.data;
            if(results){
                const products = results.response.data;
                if(products){
                    this.setState({
                        products: products
                    });
                }
            }
        })
        .catch(error => console.log(error));
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <h2>SẢN PHẨM MỚI</h2>
                    <div className="products">
                        {
                            this.state.products.map((product, i) => 
                                <ProductItem
                                    key={i}
                                    data={product}
                                />
                            )
                        }
                    </div>
                </div>
                <div className="row justify-content-center">
                    <h2>SẢN PHẨM BÁN CHẠY</h2>
                    <div className="products">
                        {
                            this.state.products.map((product, i) => 
                                <ProductItem
                                    key={i}
                                    data={product}
                                />
                            )
                        }
                    </div>
                </div>
                <div className="row justify-content-center">
                    <h2>GỢI Ý SẢN PHẨM</h2>
                    <div className="products">
                        {
                            this.state.products.map((product, i) => 
                                <ProductItem
                                    key={i}
                                    data={product}
                                />
                            )
                        }
                    </div>
                </div>

                <div className="row justify-content-center">
                    <h2>SẢN PHẨM ĐÃ XEM</h2>
                    <div className="products">
                        {
                            this.state.products.map((product, i) => 
                                <ProductItem
                                    key={i}
                                    data={product}
                                />
                            )
                        }
                    </div>
                </div>
            </div>
        );
    }
}
