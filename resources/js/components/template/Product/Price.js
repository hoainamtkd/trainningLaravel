import React, { Component } from 'react';
import { Link } from "react-router-dom";

export default class Price extends Component {
    constructor(props) {
        super(props);
    }
    render() {
        const data = this.props; 
        return (
            <span className={data._className}>{ data._price } đ</span>
        );
    }
}
