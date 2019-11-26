import React, { useState, useEffect , useRef } from "react";
import {Link} from 'react-router-dom'; 
import Slider from 'react-animated-slider';
import axios from 'axios';
import 'react-animated-slider/build/horizontal.css';
const BASE_URL = 'http://127.0.0.1:8000';

const Sliders = (props) => {
    const [slider,setDataforSlider] = useState();
    useEffect(() => {
        (async function() {
            try {
                axios.get( BASE_URL + '/api/slider?position=1')
                .then(results => { 
                    setDataforSlider(results.data.response);
                })
                .catch(error => console.log(error));
            } catch (e) {
                console.error(e);
            }
            
        })();
        // Remove cart
        localStorage.removeItem("cart_items");
    }, []);  
    return (
        <div className="wrapper_slider">
            <div className="slider-left">
                <Slider>
                    {
                        console.log(slider)
                    }
                    <div className="slider-item">
                        <img src="https://cf.shopee.vn/file/3a50c413ca4700ed552e35d44a9ade42_xxhdpi"/>
                    </div>
                    <div className="slider-item">
                        <img src="https://cf.shopee.vn/file/3a50c413ca4700ed552e35d44a9ade42_xxhdpi"/>
                    </div>
                </Slider>
            </div>
            <div className="slider-right">
                <img src="https://cf.shopee.vn/file/3a50c413ca4700ed552e35d44a9ade42_xxhdpi"/>
                <img src="https://cf.shopee.vn/file/3a50c413ca4700ed552e35d44a9ade42_xxhdpi"/>
            </div> 
        </div>
    );
};
export default Sliders;