import { useEffect, useState } from "react";

export default function List({parentState,setparentState,productid,setProductId})
{

    const [products,setProducts] = useState([])

    const goCreate = () => {
        setparentState('create')
    }

    const goItem = (id) => {
        setProductId(id)
        setparentState('item')
    }

    const getStore = async() => {
        const data = await  fetch("/seller/store/product/list", {
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
            // console.log(data)
            return data; // Работа с ответом сервера
          })
          .catch(error => {
            console.error('Error:', error); // Обработка ошибок
          })

        setProducts(data)
    }

    useEffect(()=>{getStore()},[])

    return(
        <div className="list-container">
            <h3>Список продуктов</h3>
            <button onClick={goCreate}>Создать</button>
            <table>
                <thead>
                <tr>
                    <th>№</th>
                    <th>Продукт</th>
                </tr>
                </thead>
                <tbody>
                    {
                        products.map(
                            (value,index)=>
                                <tr key={index} onClick={()=>goItem(value.id)}>
                                    <td>{++index}</td>
                                    <td>{value.name}</td>
                                </tr>
                        )
                    }
                </tbody>
            </table>
        </div>
    )
}