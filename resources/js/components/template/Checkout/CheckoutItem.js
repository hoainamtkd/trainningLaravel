import React, { useState, useEffect } from "react";
	
const CheckoutItem = (props) => {
	const data = props.data;
  	return (
        <tr>
	        <td>
	            <span className="name">{ data.title }</span>
	        </td>
	        <td>
	            <span className="pull-right">
	                { data.qty }
	            </span>
	        </td> 
	        <td>
                { 
                    new Intl.NumberFormat('de-DE', {  
                        minimumFractionDigits: 0, 
                        maximumFractionDigits: 0 
                    }).format(data.price)
                }
	        </td> 
	    </tr>
  	);
};
export default CheckoutItem;