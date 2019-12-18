import * as Types from './../constants/index';
var initialState = [];

const sliderProducer = (state = initialState, action) => { 
    switch (action.type) {
        case Types.MAIN_SLIDER: 
            const slider = action.slider.response;
        	return {
                ...state,
                slider
        	}
        default: 
        	return {
        		...state
        	};
    }
};
export default sliderProducer;