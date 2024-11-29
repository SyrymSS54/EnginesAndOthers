import { useEffect, useState } from "react";

export default function Create({parentState,setparentState})
{
    const [product,setproduct] = useState([])
    const [createStore,setCreateStore] = useState({time:'',product:'',oper:'Приход',count:1})

    const timeChange = (e) => {
      let newstore = createStore;
      newstore.time = e.target.value 
      setCreateStore(newstore)
    }

    const productChange = (e) => {
      let newstore = createStore;
      let c_product = product.find(function(elem){return elem.name == e.target.value});
      if(c_product){
        newstore.product = c_product.id;
        setCreateStore(newstore)
      } 
    }

    const operUpChange = (e) => {
      let newstore = createStore;
      newstore.oper = e.target.value 
      setCreateStore(newstore)
    }

    const operDownChange = (e) => {
      let newstore = createStore;
      newstore.oper = e.target.value 
      setCreateStore(newstore)
    }

    const countChange = (e) => {
      let newstore = createStore;
      newstore.count = e.target.value 
      setCreateStore(newstore)
    }

    const saveStore = async(e) => {
      e.preventDefault();

      let body = JSON.stringify(createStore)

    const data = await  fetch("/seller/store/create", {
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

    setparentState('list')

    }

    const getProduct = async() => {
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

        setproduct(data)
    }

    useEffect(()=>{getProduct()},[])

    return(
        <form className="create-store">
            <h3>Создание записи</h3>
            <div><label>Время записи </label><input className="input-time-data" type="date" name="date-record" required onChange={timeChange}/></div>
            <div><label>Выбор продукта </label><input className="input-product" type="text" list="product" required onChange={productChange}/></div>
            <datalist id="product">
                {
                    product.map((value,index)=>
                        <option value={value.name} key={index}/>
                    )
                }
            </datalist>
            <div className="radio"><input name="oper" type="radio" defaultChecked defaultValue="Приход" required onChange={operUpChange}/><label> Приход</label></div>
            <div className="radio"><input name="oper" type="radio" defaultValue="Расход" required onChange={operDownChange}/><label> Расход</label></div>
            <div className="count"><label>Количество </label><input name="count" type="number" defaultValue="1" required onChange={countChange}/></div>
            <input type="submit" value="Сохранить" className="submit" onClick={saveStore}/>
        </form>
    )
}