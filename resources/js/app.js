import React from "react";
import {
  	BrowserRouter,
  	Switch,
  	Route,
  	Link
} from "react-router-dom";
import ReactDOM from 'react-dom';  
import thunk from "redux-thunk";
import { createStore, applyMiddleware } from "redux";
import { Provider } from 'react-redux';
import { logger } from 'redux-logger'
import promise from 'redux-promise';

// Layout
import Header from './components/Layouts/Header';
import Footer from './components/Layouts/Footer';

// Page
import Home from './components/Home'; 
import ProductDetail from './components/ProductDetail';
import Cart from './components/Cart';
import Checkout from './components/Checkout';
import InfoOrder from './components/InfoOrder';  

// reducer
import reducer from './reducers/index';  


const store = createStore(
	reducer,
  	applyMiddleware(thunk, logger)
)
const createStoreWithMiddleware = applyMiddleware(promise)(createStore);
export default function App() {
  	return ( 
  		<Provider store={store}>
		    <BrowserRouter>
		      	<main>
			        <Header/>
			        <Switch> 
			        	<Route 
			          		path="/product/:id" 
			          		render={ (props) => <ProductDetail {...props} /> }
		          		/>
			          	<Route exact path="/">
			            	<Home />
			          	</Route>
			          	<Route path="/cart">
			            	<Cart />
			          	</Route>
			          	<Route path="/checkout/order-info">
			            	<InfoOrder />
			          	</Route>
			          	<Route path="/checkout">
			            	<Checkout />
			          	</Route>
			          	
			    	</Switch>
			    	<Footer/>
		      	</main>
		    </BrowserRouter>
	    </Provider>
  	);
}
if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
