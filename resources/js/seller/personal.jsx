import { useState } from "react";
import { createRoot } from "react-dom/client";
import Create from "./personal/create";


function Navbar({state,setState})
{
    const createChange = () =>{
        state !== 'create' ? setState('create'): null;
    }

    const updateChange = () =>{
        state !== 'update' ? setState('update'): null;
    }

    return(
        <ul className="navbar">
            <li onClick={createChange} className={state == 'create' ? 'active':'default'}>Создать</li>
            <li onClick={updateChange} className={state == 'update' ? 'active':'default'}>Изменить</li>
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
             contentState == 'update' ? contentState : contentState}
        </div>
    )
}


const rootNode = document.getElementById("content");
const root = createRoot(rootNode);
root.render(<Content/>);