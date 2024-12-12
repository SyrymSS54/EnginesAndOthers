import { useEffect, useState } from "react";
import { createRoot } from "react-dom/client";

const Search = () => {
    const [search,setSearch] = useState([]);

    const getSearch = async() => {
        let params = new URLSearchParams(document.location.search);
        let value = params.get('query');

        const data = await  fetch("/product/search/list", {
            method: "POST",
            headers: {
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body:JSON.stringify({query: value})
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

        const product_list = [...data['name'],...data['seller'],...data['tags'],...data['text']];
        setSearch(product_list.filter((obj,idx,arr)=>idx === arr.findIndex((t)=> t.name == obj.name)))
    }

    useEffect(()=>{getSearch()},[])

    const goProductLink = (id) => {
      document.location = "/product?id=" + id
    }

    return(
        <div className="product-list">
            {
                search.map((product,index)=>
                <div className="product" key={index}>
                    <img src={"/images/" + product.description.preview}/>
                    <div className="name">{product.name}</div>
                    <div className="text">{product.description.text}</div>
                    <button onClick={()=>goProductLink(product.id)}>Посмотрет</button>
                </div>
                )
            }
        </div>
    )
}

const rootNode = document.getElementById("app");

console.log(rootNode);

const root = createRoot(rootNode);
root.render(<Search/>);
