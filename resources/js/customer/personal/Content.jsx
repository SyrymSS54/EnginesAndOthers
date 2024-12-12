import { useState } from "react";
import Navbar from "./Navbar";
import Cart from "./Cart";
import Order from "./Order";
import History from "./History";


export default function Content(){
    const [contentType,setContentType] = useState('cart');

    return(
        <div className="app-container">
            <Navbar content={contentType} setContent={setContentType}/>
            {contentType == 'cart' ? <Cart content={contentType} setContent={setContentType}/> : 
             contentType == 'order' ? <Order content={contentType} setContent={setContentType}/> :
             contentType == 'history' ? <History/> : 'no content'}
        </div>
    )
}