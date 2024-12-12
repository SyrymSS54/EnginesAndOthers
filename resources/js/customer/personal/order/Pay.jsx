import { useState } from "react";

export default function Pay({orderItem,orderState,setOrderContent})
{
    const ClickPay = async(order_id) => {
        const data = await  fetch("/order/pay", {
            method: "POST",
            headers: {
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body:JSON.stringify({id:order_id})
          })
          .then(response => {
            return response.json();
          })
          .then(data => {
            console.log(data)
            return data; 
          })
          .catch(error => {
            console.error('Error:', error); 
          })

        setOrderContent('list')
    }

    return(
        <div>
            <button className="pay-button" onClick={()=>{ClickPay(orderItem)}}>Оплатить</button>
        </div>
    )
}