import React from "react";
import {
  	BrowserRouter,
  	Switch,
  	Route,
  	Link
} from "react-router-dom";
import ReactDOM from 'react-dom'; 
// Layout
import Header from './components/Layouts/Header';
import Footer from './components/Layouts/Footer';

// Page
import Home from './components/Home'; 
import ProductDetail from './components/ProductDetail';
import Cart from './components/Cart';
import Checkout from './components/Checkout';
import InfoOrder from './components/InfoOrder';


export default function App() {
  	return (
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
  	);
}
if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
