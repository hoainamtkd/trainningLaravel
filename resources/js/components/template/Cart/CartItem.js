import React, { useState, useEffect } from "react";

const CartItem = () => { 
	const [id,deleteCart] = useState(0);
	useEffect(() => { 
		if(id !== 0){
			alert(1);
		}
	});
  	return (
		<li> 
            <a href="#">Lorem Ipsum is simply dummy text lorem Ipsum is simply dummy text...</a>
            <a onClick={() => deleteCart(8)} className="label-remove">Xóa</a>
        </li>
  	);
};
export default CartItem;