import React, { Component } from 'react';
import { Link } from "react-router-dom";

export default class Header extends Component {
    render() {
        return (
            <div className="container">
                <nav className="navbar navbar-expand-lg navbar-light bg-light"> 
                        <Link to="/" className="navbar-brand">Woocommerce</Link>
                        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span className="navbar-toggler-icon"></span>
                        </button>
                        <div className="collapse navbar-collapse" id="navbarText">
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item"> 
                                <Link to="/" className="nav-link">Home</Link>
                            </li>
                            <li className="nav-item"> 
                                <Link to="/about" className="nav-link">About</Link>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        );
    }
}
