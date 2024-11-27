import { useState } from "react";



export default function Create()
{
    const [inputValue, setInputValue] = useState(['']);

    const AddInputTags = (e) => {
        setInputValue([...inputValue,''])
    }

    const UpdateInputValue =(value,index) =>{
        let newItems = [...inputValue]
        newItems[index] = value
        setInputValue(newItems)
    }

    return(
        <div className="app-container">
            <form method="post" action="/seller/product/create" className="create-container" encType="multipart/form-data">
                <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]').content} />
                <div className="input-container">
                    <label>Название продукта</label>
                    <input type="text" name="name" required/>
                </div>
                <div className="input-container">
                    <label>Описание продукта</label>
                    <input type="text" name="text" required/>
                </div>
                <div className="input-container">
                    <label>Превью фото</label>
                    <input name="preview" required type="file"/>
                </div>
                <div className="input-container">
                    <label>Фото проекта</label>
                    <input name="photos[]" required multiple type="file"/>
                </div>
                <div className="input-container">
                    <label>Индекс товара</label>
                    <input name="index" required type="text"/>
                </div>
                <div className="input-container">
                    <label>Тэг товара</label>
                    {inputValue.map((value,index)=>(
                        
                        <input name="tags[]" required type="text" key={index} defaultValue={value} index={index} onChange={(event)=>UpdateInputValue(event.target.value,index)}/>
                    ))}
                    <button onClick={AddInputTags}>Добавить тэг</button>
                </div>
                <div className="input-container">
                    <label>Цена продукта</label>
                    <input name="info[price]" required type="number" step="0.01" min="0"/>
                </div>
                <div className="input-container">
                    <label>Скидка на продукта</label>
                    <input name="info[sale]" required type="number" step="1" min="0" max="100"/>
                </div>
                <div className="input-container">
                    <label>Количество продукта</label>
                    <input name="info[count]" required type="number" step="1" min="1"/>
                </div>
                <div className="input-container">
                    <label>Активный<input name="info[status_sale]" required type="radio" defaultValue={1}/></label>
                </div>
                <input type="submit" value="Создать"/>
            </form>
        </div>
    )
}