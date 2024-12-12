import { useEffect, useState } from "react";
import List from "./order/List";

export default function Order()
{
    const [orderState, setOrderState] = useState('list') //list item
    const [orders,setOrders] = useState([])

    const clickConsideration = async(order_id) => {
      const data = await  fetch("/seller/order/consideration", {
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
      getOrders()
    }

    const clickexecution = async(order_id) => {
      const data = await  fetch("/seller/order/execution", {
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
      getOrders()
    }

    const clickCancellation = async(order_id) => {
      const data = await  fetch("/seller/order/cancellation", {
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
      getOrders()
    }

    const getOrders = async() => {
        const data = await  fetch("seller/order", {
            method: "POST",
            headers: {
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
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

        setOrders(data);

    }

    useEffect(()=>{getOrders()},[]);

    return(
        <div className="app-container">
            {orderState == 'list' ? <h3>Список заказов</h3> : ''}
            <List orders={orders} consideration={clickConsideration} cancellation={clickCancellation} execution={clickexecution}/>
        </div>
    )
}