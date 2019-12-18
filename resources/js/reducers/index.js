import { combineReducers } from 'redux';
import productReducer from './productProducer';
import sliderProducer from './sliderProducer';

const rootReducer = combineReducers({
	products: productReducer,
	slider: sliderProducer
});
export default rootReducer;