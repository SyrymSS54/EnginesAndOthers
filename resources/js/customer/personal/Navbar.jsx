import { useState } from "react";

export default function Navbar({content,setContent})
{
    return(
        <ul className="navbar">
            <li className={content == 'cart' ? 'active' : ''} onClick={()=>{content == 'cart' ? '' : setContent('cart')}}>Корзина</li>
            <li className={content == 'history' ? 'active' : ''} onClick={()=>{content == 'history' ? '' : setContent('history')}}>История</li>
        </ul>
    )
}