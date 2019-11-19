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
import Example from './components/Example';


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
		          	<Route path="/example">
		            	<Example />
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
