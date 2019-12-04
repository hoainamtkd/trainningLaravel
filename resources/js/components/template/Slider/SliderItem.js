import React, { useState, useEffect , useRef } from "react";
import {Link} from 'react-router-dom'; 

const SliderItem = (props) => {   
    return (
        <div className="slider-item">
            <img src={props.data_src}/>
        </div>
    );
};
export default SliderItem;