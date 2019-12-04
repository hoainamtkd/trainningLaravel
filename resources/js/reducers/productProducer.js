import * as Types from './../constants/index';
var initialState = [];

const productProducer = (state = initialState, action) => {
    switch (action.type) {
        case Types.FETCH_PRODUCTS:
        	const products = action.products.response.data;
        	return {
        		...state,
        		products
        	}
        default: 
        	return [...state];
    }
};

export default productProducer;