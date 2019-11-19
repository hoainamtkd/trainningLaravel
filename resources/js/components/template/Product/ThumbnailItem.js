import React, { Component } from 'react';

export default class ThumbnailItem extends Component {
    constructor(props) {
        super(props);
    }
    render() {
        const props = this.props;
        return (
            <div className = "gallery-item">
            	<img src={ props.data } />
            </div>
        );
    }
}
