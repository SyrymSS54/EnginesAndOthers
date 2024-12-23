import { useEffect, useState } from "react";

export default function Cart(){
  const [cart,setCart] = useState([])
  const [auth,setAuth] =useState(false)

  const AuthCheck = async() => {
    const data = await  fetch("/check/customer", {
      method: "GET",
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

    setAuth(data['check']);
  }

  const createCart = async() => {
    let params = new URLSearchParams(document.location.search);
    let value = params.get('id')

    console.log(value)

    let body = JSON.stringify({product_id: value})

    console.log(body)

    if(auth){
    const data = await  fetch("/customer/cart/create", {
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
      return data; // Работа с ответом сервера
    })
    .catch(error => {
      console.error('Error:', error); // Обработка ошибок
    })}
    else{
      document.location = '/customer/auth/signin';
    }
  }

  const checkCart = async() => {
    let params = new URLSearchParams(document.location.search);
    let value = params.get('id')

    let body = JSON.stringify({product_id: value})

    const data = await  fetch("/customer/cart/check", {
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

    AuthCheck()
    setCart(data)
  }

  useEffect(()=>{checkCart()},[])

  const upSet =async()=>{
    let params = new URLSearchParams(document.location.search);
    let value = params.get('id')

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

  const downSet =async()=>{
    let params = new URLSearchParams(document.location.search);
    let value = params.get('id')

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

  return(
    <div className="cart">
      {cart.length === 0 ? <button onClick={()=>{createCart();checkCart()}}>Корзина</button> :
      <ul className="cart-data">
        <li><button onClick={()=>{upSet();checkCart()}}>+ </button></li>
        <li>{cart['count']}</li>
        <li><button onClick={()=>{downSet();checkCart()}}> -</button></li>
      </ul>
      }
    </div>
  )
}