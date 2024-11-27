import { useState } from "react";
import Navbar from "./Navbar";
import Cart from "./Cart";


export default function Content(){
    const [contentType,setContentType] = useState('cart');

    return(
        <div className="app-container">
            <Navbar content={contentType} setContent={setContentType}/>
            {contentType == 'cart' ? <Cart/> : 'no car'}
        </div>
    )
}