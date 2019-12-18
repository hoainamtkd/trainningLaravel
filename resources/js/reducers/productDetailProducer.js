import * as Types from './../constants/index';

var initialState = {};

const itemEditing = (state = initialState, action) => {
    switch(action.type){
        case Types.PRODUCT_DETAIL: 
            return {
            	...state,
            };
        default:
            return state;
    }
}

export default itemEditing;
