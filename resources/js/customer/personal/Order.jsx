import { useState } from "react";
import List from "./order/List";
import Item from "./order/Item";
import Pay from "./order/Pay";

export default function Order({content,setContent})
{
    const [orderState,setOrderContent] = useState('list'); // list item pay
    const [focusOrderItem,setFocusOI] = useState('');
    const [order,setorder] =useState([]);

    return(
        <div className="content">
            <h3>
                {
                orderState == 'list' ? 'Список заказов' : 
                orderState == 'pay' ? 'Оплата':
                orderState == 'item' ?  'Заказ' : 'Error'
                }
            </h3>
            {
                orderState == 'list' ? <List orderItem={focusOrderItem} setOrderItem={setFocusOI} setOrderContent={setOrderContent} setOrder={setorder}/> :
                orderState == 'pay' ? <Pay orderItem={focusOrderItem} orderState={orderState} setOrderContent={setOrderContent}/>  :
                orderState == 'item' ? <Item orderItem={focusOrderItem} setOrderItem={setFocusOI} order={order}/> : ""
            }
        </div>
    )
}