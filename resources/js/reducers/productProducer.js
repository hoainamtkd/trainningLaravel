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
        case Types.PRODUCT_DETAIL:
        	return {
				...state,
				product : action.product.response
			}
		case Types.PRODUCT_DETAIL:
				return {
					...state,
					product : action.product.response
				}
		case Types.UPDATE_AMOUNT:
			const qty = action.qty;
			return {
				...state,
				qty
			}
        default: 
        	return [...state];
    }
};
export default productProducer;