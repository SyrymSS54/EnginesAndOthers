import { useState } from "react";
import Create from "./store/Create";
import List from "./store/List";
import Item from "./store/Item";

export default function Store(){
    const [storeState,setStoreState] = useState('list') // list create item
    const [productId,setProductId] = useState('')

    console.log(productId)

    return(
        <div className="store-container">
            {
                storeState == 'list' ? <List parentState={storeState} setparentState={setStoreState} productid={productId} setProductId={setProductId}/>:
                storeState == 'create' ? <Create parentState={storeState} setparentState={setStoreState}/>:
                storeState == 'item' ? <Item parentState={storeState} setparentState={setStoreState} productid={productId} setProductId={setProductId}/>: null
            }
        </div>
    )
}