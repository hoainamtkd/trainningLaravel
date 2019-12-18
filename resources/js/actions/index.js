import callApi from './../utils/apiCaller';
import * as Types from './../constants/index';
// ===================================================== //
export const actFetchProductsRequest = () => {
    return async dispatch => {
        const res = await callApi('/api/products', 'GET', null);
        dispatch(actFetchProducts(res.data));
    };
}

export const actFetchProducts = (products) => {
    return {
        type : Types.FETCH_PRODUCTS,
        products
    }
}

export const actGetProductRequest = (id) => {
    return async dispatch => {
        const res = await callApi('/api/products/' + id, 'GET', null);
        dispatch(actGetProduct(res.data));
    }
}
// ===================================================== //
export const actGetProduct = (product) => {
    return {
        type : Types.PRODUCT_DETAIL,
        product
    }
}

export const actUpdateAmount = (qty , product) => {
    product['qty'] = qty;
    return {
        type : Types.UPDATE_AMOUNT,
        product
    }
}
// ===================================================== //

export const actFetchProductRelative = (id) => {
    return async dispatch => {
        const res = await callApi('/api/related-products/' + id, 'GET', null);
        dispatch(actGetProductRelative(res.data));
    };
}
export const actGetProductRelative = (data) => {
    const product_relative = data.response.data; 
    return {
        type : Types.PRODUCT_RELATIVE,
        product_relative
    }
}
// ===================================================== //
export const actFetchSlider = () => {
    return async dispatch => {
        const res = await callApi('/api/slider?position=1', 'GET', null);
        dispatch(acGetSlider(res.data));
    };
}

export const acGetSlider = (slider) => { 
    return {
        type : Types.MAIN_SLIDER,
        slider
    }
}