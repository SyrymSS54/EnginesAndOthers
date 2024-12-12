import { useEffect, useState } from "react";

export default function History()
{
    const [orders,setOrders] = useState([])

    const getHistory = async() => {
        const data = await  fetch("/order/history", {
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

          setOrders(data)
    }

    useEffect(()=>{getHistory()},[])

    const goProduct = (id) => {
        document.location.href = "/product?id=" + id
    }

    return(
        <div className="history-list">
            <h3>История</h3>
            {
                orders.map(
                    (value,index) => 
                        <div className="order_item" key={index}>
                            <h4 className="order-title">Заказ №{value.order_id}</h4>
                            <h4 className="order-state">Состояние: {value.state == 0 ? "Не оплачено": value.state == 1 ? 'На отработке' : value.state == 2 ? "На доставке" : value.state == 3 ? "Выполнен" : value.state == 4 ? 'Отменен' : "Error"}</h4>
                            <ul className="product-list">
                                {
                                    value.products.map(
                                        (product,index)=>
                                            // <li key={index} className="product-item"><label className="product-name">{product.description.name}</label><label className="product-count">Количество {product.count}</label></li>
                                            <div className="product-item" key={index}>
                                                <img src={"/images/" + product.description.description.preview} onClick={()=>goProduct(product.description.id)}></img>
                                                <ul>
                                                    <li>{product.description.name}</li>
                                                    <li>{product.description.description.text}</li>
                                                    <li><label>Количество</label> {product.count}</li>
                                                </ul>
                                            </div>
                                        )
                                }
                            </ul>
                        </div>
                )
            }
        </div>
    )
}