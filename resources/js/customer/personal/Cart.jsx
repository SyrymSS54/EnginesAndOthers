import { useEffect, useState } from "react";


export default function Cart({content,setContent})
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
          console.log(data)
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

    const linkClick = (product_id) => {
      document.location.href = "/product?id=" + product_id;
    }

    const goOrder = async(product) => {
      console.log('111 ',product)
      let body = JSON.stringify({
        seller_name: product[0].seller_name,
        seller_id: product[0].seller_id,
        products: product.map((item)=>{
          return {product_id: item.product_id, count: item.count, id:item.id}
        }), 
      })


        const data = await  fetch("/order/create", {
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
        
        setContent('order')
      }

    return(
        <div className="content">
          <h3>Корзина</h3>
            {
                Object.keys(carts).map((value,index)=>
                <div className="cart-container" key={index}>
                    <div className="seller-title">{value}</div>
                    <ul className="carts-list">
                        {
                            carts[value].map((cart,i)=>
                                <li className="cart" key={i}>
                                  <img src={"/images/" + cart.product.description.preview} onClick={()=>linkClick(cart.product_id)}/>
                                  <div className="description">
                                    <label className="name">{cart.product_name}</label>
                                    <label className="name">{cart.product.description.text}</label>
                                    <label className="count"><button className="button" onClick={()=>{upSet(cart.product_id);getCarts()}}>+ </button>{cart.count}<button className="button" onClick={()=>{downSet(cart.product_id);getCarts()}}> -</button><button className="delete" onClick={()=>{deleteSet(cart.product_id),getCarts()}}><img alt="delete"></img></button></label>
                                  </div>
                                </li>
                            )
                        }
                    </ul>
                    <button onClick={()=>goOrder(carts[value])}>Заказать</button>
                </div>
                )
            }
        </div>
    )
    
}