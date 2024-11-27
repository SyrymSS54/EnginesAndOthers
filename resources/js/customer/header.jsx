import { useState } from "react";
import { createRoot } from "react-dom/client";

export default function Search()
{
    const [query,setQuery] = useState('');

    return(
        <div className="search-container">
            <input id="search" className="search-input" required placeholder="...Search" onChange={(e) =>setQuery(event.target.value)}/>
            <button className="button" onClick={(e) => {document.location.href = '/product/search?query=' + query}}>Поиск</button>
        </div>
    )
}

const rootNode = document.getElementById("search");
const root = createRoot(rootNode);
root.render(
    <Search/>
);