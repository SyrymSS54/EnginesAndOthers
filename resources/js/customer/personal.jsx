import { createRoot } from "react-dom/client";
import Content from "./personal/Content";


const rootNode = document.getElementById("app");
const root = createRoot(rootNode);
root.render(<Content/>);