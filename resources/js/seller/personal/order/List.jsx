import { useEffect } from "react"

export default function List({orders,consideration,execution,cancellation})
{
    useEffect(()=>{console.log(orders)},[])


    return(
        <ul className="order-container">
            {
                orders.map((order,index)=>
                <li key={index} className="order-list">
                    <h4> Заказ{order.order_id}</h4>
                    <h4 className="order-state">Состояние: {order.state == 0 ? "Не оплачено": order.state == 1 ? 'На отработке' : order.state == 2 ? "На доставке" : order.state == 3 ? "Выполнен" : order.state == 4 ? 'Отменен' : "Error"}</h4>
                    <h4> Время заказа {order.created_at}</h4>
                    <ul className="order-products">
                        {
                            order.products.map((product,index)=>
                            <li key={index} className="product">
                                <label>Товар: </label>{product.description.name}
                                <label>Количество: </label>{product.count}
                            </li>
                            )
                        }
                    </ul>
                    {
                        order.state == 1 ? <button onClick={()=>consideration(order.id)}>Сформировать</button> : order.state == 2 ? <button onClick={()=>execution(order.id)}>Доставлен</button> : ''
                    }
                    {
                        order.state !== 4 ? <button onClick={()=>cancellation(order.id)}>Отменить</button> : ''
                    }
                    
                </li>
                )
            }
        </ul>
    )
}