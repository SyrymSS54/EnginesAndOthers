import { useState } from "react";
import { createRoot } from "react-dom/client";
import Create from "./personal/create";
import Store from "./personal/store";
import Order from "./personal/order";
import Statistics from "./personal/statistics";


function Navbar({state,setState})
{
    const createChange = () =>{
        state !== 'create' ? setState('create'): null;
    }

    const updateChange = () =>{
        state !== 'update' ? setState('update'): null;
    }

    const storeChange = () => {
        state !== 'store' ? setState('store'):null;
    }

    const orderChange = () => {
        state !== 'order' ? setState('order'):null;
    }

    const statisticsChange = () => {
        state !== 'statistics' ? setState('statistics'):null;

    }

    return(
        <ul className="navbar">
            <li onClick={createChange} className={state == 'create' ? 'active':'default'}>Создать</li>
            <li onClick={updateChange} className={state == 'update' ? 'active':'default'}>Изменить</li>
            <li onClick={storeChange} className={state == 'store' ? 'active':'default'}>Склад</li>
            <li onClick={orderChange} className={state == 'order' ? 'active':'default'}>Заказы</li>
            <li onClick={statisticsChange} className={state == 'statistics' ? 'active': 'default'}>Статистика</li>
        </ul> 
    )
}

function Content()
{
    const [contentState,setContent] = useState('create')

    return(
        <div className="app">
            <Navbar state={contentState} setState={setContent}/>
            {contentState == 'create' ? <Create/>:
             contentState == 'update' ? contentState : 
             contentState == 'store' ? <Store/>: 
             contentState == 'order' ? <Order/>:
             contentState == 'statistics' ? <Statistics/>:contentState}
        
        </div>
    )
}


const rootNode = document.getElementById("content");
const root = createRoot(rootNode);
root.render(<Content/>);