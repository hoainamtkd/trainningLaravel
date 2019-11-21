import React, { useState, useEffect } from "react";
	
const CartItem = (props) => { 
	const [id , deleteCart] = useState(0);
	if(id){
		props.updateCart(props);
	}
	const cart_item_storage = JSON.parse(localStorage.getItem('cart_items'));
	useEffect(() => { 
		if(id !== 0){
			let position = -1;
	        cart_item_storage.map(function(e,i) {
                if(id === e.id){
                    e.qty++;
                    position = i;
                }
            });
	        if (position > -1) {
	            cart_item_storage.splice(position, 1);
	            localStorage.setItem('cart_items', JSON.stringify(cart_item_storage));
	        }
		}
	});

 	let [qty , productQty] = useState(0);
 	if(qty){
 		props.data.qty = qty
 		props.updateQty(props);
 	} 
 	
	const background = { 
        backgroundImage: `url(${props.data.image})`,
        backgroundSize: 'cover',
        backgroundPosition: 'center center',
    };

  	return (
        <tr className={ 'cart_item_' + props.data.id }>
            <td>{ props.item_number }</td>
            <td className="feature_img">
            	<div className="img" style={ background }></div>
            </td>
            <td>
            	{ props.data.title }
            </td>
            <td className="qty">
            	<input 
	            	className="form-control" 
	            	value={ qty ? qty : props.data.qty }
	            	onChange={e => productQty(e.target.value)}
            	/>
            </td>
            <td>
	            { 
	        		new Intl.NumberFormat('de-DE', {  
			          	minimumFractionDigits: 0, 
			          	maximumFractionDigits: 0 
		        	}).format(props.data.price)
		        }
            </td>
            <td>
	            { 
	            	new Intl.NumberFormat('de-DE', {  
			          	minimumFractionDigits: 0, 
			          	maximumFractionDigits: 0 
		        	}).format(props.data.price * props.data.qty)
	            }
            </td> 
            <td><a href="javascript:void(0)" onClick={() => deleteCart(props.data.id)}>Delete</a></td>
        </tr>
  	);
};
export default CartItem;