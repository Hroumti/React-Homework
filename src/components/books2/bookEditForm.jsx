import React, {useRef, useContext, useEffect} from "react";
import { BookContext } from "./bookContext";
import { useParams } from "react-router-dom";

export default function BookEditForm(){
    const {id} = useParams()

    const {books, updateBook} = useContext(BookContext)
    const book = books.find(b=>b.id==id)
    
    const title = useRef('')
    const author = useRef('')
    
    useEffect(() => {
        if (book && title.current && author.current) {
            title.current.value = book.title;
            author.current.value = book.author;
        }
    }, []);


    function handleSubmit(e){
        e.preventDefault()
        let t = title.current.value
        let a = author.current.value
        if(t.trim()!==''&&a.trim()!==''){
            updateBook({id:Number(id), title:t, author:a})
            title.current.value = ''
            author.current.value = ''

        }
    }

    return(
        <form onSubmit={(e)=>handleSubmit(e)}>
            <input type="text" ref={title} placeholder="Title"/>
            <input type="text" ref={author} placeholder="Author"/>
            <input type="submit" value="Update"/>
        </form>
    )




}