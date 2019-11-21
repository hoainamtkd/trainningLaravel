import React from "react";
    
const Message = (props) => {    
    return (
        <div id="alert" className="alert alert-success"> 
            { props.message_status }
        </div>
    );
};
export default Message;