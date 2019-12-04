import callApi from './../utils/apiCaller';
import * as Types from './../constants/index';

export const actFetchProductsRequest = () => {
    return dispatch => {
        return callApi('/api/products', 'GET', null).then(res => {
            dispatch(actFetchProducts(res.data));
        });
    };
}

export const actFetchProducts = (products) => {
    return {
        type : Types.FETCH_PRODUCTS,
        products
    }
}

export const actGetProductRequest = (id) => {
    return dispatch => {
        return callApi('/api/products/'+id, 'GET', null).then(res => {
            dispatch(actGetProduct(res.data));
        });
    }
}

export const actGetProduct = (product) => {
    return {
        type : Types.PRODUCT_DETAIL,
        product
    }
}