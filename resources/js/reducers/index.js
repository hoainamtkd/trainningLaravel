import { combineReducers } from 'redux';
import productReducer from './productProducer';
const rootReducer = combineReducers({
  	products: productReducer
});
export default rootReducer;