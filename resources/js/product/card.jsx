import { useState } from "react";
import { createRoot } from "react-dom/client";
import Cart from "./card/Cart";




const rootNode = document.getElementById("cart");
const root = createRoot(rootNode);
root.render(<Cart/>);


