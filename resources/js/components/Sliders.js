import React, { useState, useEffect , useRef } from "react";
import {Link} from 'react-router-dom'; 
import Slider from 'react-animated-slider';
import axios from 'axios';
import 'react-animated-slider/build/horizontal.css'; 

import SliderItem from './template/Slider/SliderItem';

const BASE_URL = 'http://127.0.0.1:8000';

const Sliders = (props) => {
    const [slider,setDataforSlider] = useState();
    const [slider2,setDataforSlider2] = useState();

    const [is_loaded,windowLoaded] = useState(false);
    useEffect(() => {
        (async function() {
            try {
                // Main banner
                axios.get( BASE_URL + '/api/slider?position=1')
                .then(results => { 
                    setDataforSlider(results.data.response);
                    windowLoaded(true);
                })
                .catch(error => console.log(error));

                // Banner right
                axios.get( BASE_URL + '/api/slider?position=2')
                .then(results => { 
                    setDataforSlider2(results.data.response);
                    windowLoaded(true);
                })
                .catch(error => console.log(error));
            } catch (e) {
                console.error(e);
            }
        })();  
    }, []);   
    return (
        <div className="wrapper_slider">
            <div className="slider-left">
                <Slider>
                    <SliderItem data_src="https://cf.shopee.vn/file/3a50c413ca4700ed552e35d44a9ade42_xxhdpi"/>
                    <SliderItem data_src="https://cf.shopee.vn/file/a147c14742fc661de84817da6013cc64_xxhdpi"/>
                    <SliderItem data_src="https://cf.shopee.vn/file/3a50c413ca4700ed552e35d44a9ade42_xxhdpi"/>
                    <SliderItem data_src="https://cf.shopee.vn/file/a147c14742fc661de84817da6013cc64_xxhdpi"/>
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