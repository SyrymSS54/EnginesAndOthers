import { useEffect, useState } from "react";


export default function Cart()
{
    const [carts,setCart] = useState([])

    const getCarts = async() => {
        const data = await  fetch("/customer/cart", {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        .then(response => {
          return response.json();
        })
        .then(data => {
          return data; // Работа с ответом сервера
        })
        .catch(error => {
          console.error('Error:', error); // Обработка ошибок
        })

        setCart(data.reduce((accum,value)=>{
            if(!accum[value.seller_name])
            {
                accum[value.seller_name] = []
            }
            accum[value.seller_name].push(value)

            return accum
        },{}))
    }

    const upSet =async(value)=>{
    
        let body = JSON.stringify({product_id: value})
    
        const data = await  fetch("/cart/up", {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: body
        })
        .then(response => {
          return response.json();
        })
        .then(data => {
          console.log(data)
          return data; // Работа с ответом сервера
        })
        .catch(error => {
          console.error('Error:', error); // Обработка ошибок
        })
    }

    const downSet =async(value)=>{
        let body = JSON.stringify({product_id: value})
    
        const data = await  fetch("/cart/down", {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: body
        })
        .then(response => {
          return response.json();
        })
        .then(data => {
          console.log(data)
          return data; // Работа с ответом сервера
        })
        .catch(error => {
          console.error('Error:', error); // Обработка ошибок
        })
    }

    const deleteSet =async(value)=>{
        let body = JSON.stringify({product_id: value})
    
        const data = await  fetch("/customer/cart/delete", {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: body
        })
        .then(response => {
          return response.json();
        })
        .then(data => {
          console.log(data)
          return data; // Работа с ответом сервера
        })
        .catch(error => {
          console.error('Error:', error); // Обработка ошибок
        })
    }
    
    
    useEffect(()=>{getCarts()},[])

    console.log(carts)
    return(
        <div className="content">
            {
                Object.keys(carts).map((value,index)=>
                <div className="cart-container" key={index}>
                    <div className="seller-title">{value}</div>
                    <ul className="carts-list">
                        {
                            carts[value].map((cart,i)=>
                                <li className="cart" key={i}>
                                    <label className="name">{cart.product_name}</label>
                                    <label className="count"><button className="button" onClick={()=>{upSet(cart.product_id);getCarts()}}>+ </button>{cart.count}<button className="button" onClick={()=>{downSet(cart.product_id);getCarts()}}> -</button><button className="delete" onClick={()=>{deleteSet(cart.product_id),getCarts()}}><img alt="delete"></img></button></label>
                                </li>
                            )
                        }
                    </ul>
                </div>
                )
            }
        </div>
    )
    
}