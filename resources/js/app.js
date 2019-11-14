import React from "react";
import {
  	BrowserRouter,
  	Switch,
  	Route,
  	Link
} from "react-router-dom";
import ReactDOM from 'react-dom';
import Header from './components/layouts/Header';
import Footer from './components/layouts/Footer';
import Home from './components/Home'; 


export default function App() {
  	return (
	    <BrowserRouter>
	      	<div>
		        <Header/>
		        <Switch> 
		          	<Route exact path="/">
		            	<Home />
		          	</Route>
		    	</Switch>
	      	</div>
	    </BrowserRouter>
  	);
}
if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
