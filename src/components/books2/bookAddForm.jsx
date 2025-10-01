import React, {useContext, useRef} from "react";
import { BookContext } from "./bookContext";

export default function BookAddForm(){
    const {addBook} = useContext(BookContext)

    const title = useRef('')
    const author = useRef('')

    function handleSubmit(e){
        e.preventDefault()
        let t = title.current.value
        let a = author.current.value
        if(t.trim()!==''&&a.trim()!==''){
            addBook({title:t, author:a})   
            title.current.value = ''
            author.current.value = ''
        }
    }

    return(
        <form onSubmit={(e)=>handleSubmit(e)}>
            <input type="text" ref={title} placeholder="Title"/>
            <input type="text" ref={author} placeholder="Author"/>
            <input type="submit" value="Submit"/>
        </form>
    )
}