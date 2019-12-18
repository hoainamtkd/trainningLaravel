import React, { Component } from 'react';
import { Link } from "react-router-dom";
import axios from 'axios';
import ProductItemRelated from './ProductItemRelated';


const BASE_URL = 'http://127.0.0.1:8000';

export default class RelateProduct extends Component {
    constructor(props) {
        super(props);
        this.state = {
            products : []
        }; 
    }

    componentDidMount(){ 
    	const path = BASE_URL + '/api/related-products/'+ this.props.id; 
        axios.get( path )
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
        .catch(error => 
            console.log(error)
        );
    }

    render() { 
    	const data = this.state.products;
    	const background = { 
            backgroundImage: `url(${data.feature_image})`,
            backgroundSize: 'cover',
            backgroundPosition: 'center center',
        };
        return (
        	<div className="product-relative">
        		{
                    data.map((product, i) => 
                        <ProductItemRelated
                            key={i}
                            data={product}
                        />
                    )
                }
        	</div>
        );
    }
}
