import { useEffect, useState } from "react";

export default function Item({orderItem,setOrderItem,order})
{

    console.log(order)

    return(
        // <div className="order-item">
        //   <button>Назад</button>
        //   <label>Номер заказа {order.order_id}</label>
        //   <label>продавец {order.seller_name}</label>
        //   <label>{order.state == 0 ? "Не оплачено": order.state == 1 ? 'На отработке' : order.state == 2 ? "На доставке" : order.state == 3 ? "Выполнен" : order.state == 4 ? 'Отменен' : "Error"}</label>
        //   <div className="product-action">
        //     {
        //       order.products.map((product,index)=>
        //       <div className="product" key={index}>
        //         <img src={"/images/" + product.description.description.preview}></img>
        //         <div className="productdescription">
        //           <label>{product.description.name}</label>
        //           <label>{product.description.description.text}</label>
        //           <label>Количество {product.count}</label>
        //         </div>
        //       </div>
        //       )
        //     }
        //   </div>
        // </div>
        <div className="order_item">
                            <h4 className="order-title">Заказ №{order.order_id}</h4>
                            <h4 className="order-state">Состояние: {order.state == 0 ? "Не оплачено": order.state == 1 ? 'На отработке' : order.state == 2 ? "На доставке" : order.state == 3 ? "Выполнен" : order.state == 4 ? 'Отменен' : "Error"}</h4>
                            <ul className="product-list">
                                {
                                    order.products.map(
                                        (product,index)=>
                                            <li key={index} className="product-item"><label className="product-name">{product.description.name}</label><label className="product-count">Количество {product.count}</label></li>
                                        )
                                }
                            </ul></div>
    )
}