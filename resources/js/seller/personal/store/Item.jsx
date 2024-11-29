import { useEffect, useState } from "react";

export default function Item({parentState,setparentState,productid,setProductId})
{
    const [productData,setProductData] = useState({})

    const getStoreitem = async() => {
        const body = JSON.stringify({product: productid})

        const data = await  fetch("/seller/store/item", {
            method: "POST",
            headers: {
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body:body
          })
          .then(response => {
            return response.json();
          })
          .then(data => {
            // console.log(data)
            return data; // Работа с ответом сервера
          })
          .catch(error => {
            console.error('Error:', error); // Обработка ошибок
          })

        setProductData(data)

        console.log(Object.keys(data).length )
        if(Object.keys(data).length <= 1){
            setparentState('create')
        }
        else
        {
            setProductData(data)
        }
    }

    useEffect(()=>{getStoreitem()},[])

    return(
        <div className="item-container">
            <h3>{productData.name}</h3>
            <button onClick={()=>{setparentState('craete')}}>Создать</button>
            <table>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Количество</th>
                        <th>Операция</th>
                        <th>Время</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        Object.keys(productData).length > 1 ? productData.records.map((value,index)=>
                        <tr key={index}>
                            <td>{index+1}</td>
                            <td>{value.count}</td>
                            <td>{value.oper}</td>
                            <td>{value.time}</td>
                        </tr> 
                        ) : ''
                    }
                </tbody>
            </table>
        </div>
    )
}