import React, {useState, useRef, useEffect} from "react"; 
import Render from './render'
export default function Main(){

    //ref
    const title = useRef('')
    const author = useRef('')
    const rating = useRef(0)
    const liked = useRef(false)

    //state
    const [books, setBooks] = useState([])
    const [id, setId] = useState(0)


//effect
useEffect(() => {
    fetch('/books.json') 
        .then(res => {
            if (!res.ok) {
                throw new Error(`Failed to fetch local file: ${res.status}`);
            }
            return res.json();
        })
        .then(data => {
            setBooks(data.books);
            setId(data.books.length + 1); 
        })
        .catch(err => console.error("Data Fetch Error:", err));
}, []);


    //submit
    function handleSubmit(e){
        e.preventDefault()
        if (title.trim !== '' && author.trim !== '') {
            setBooks([...books, {id, title:title.current.value, author:author.current.value, rating:0, liked:false}])
            setId(id+1)
        } else{
            alert('Invalid input!!!')
        }
    }

    //delete
    function deleteBook(deletedId){
        setBooks(books.filter(b=>b.id!==deletedId))
    }

    function toggleLiked(toggleId){
        setBooks(books.map(b=>b.id===toggleId?{...b, liked:!b.liked}:b))
    }

    //update rating
    function updateRating(idToUpdate, newRating){
        setBooks(books.map(b=>b.id===idToUpdate?{...b, rating:newRating}:b))
    }

return(
    <div id="container">
        <form onSubmit={(e)=>handleSubmit(e)}>
            <input type="text" ref={title} placeholder="Title"/>
            <input type="text" ref={author} placeholder="Author"/>
            <input type="submit" value='Submit'/>
        </form>
        <Render books={books} deleteBook={deleteBook} toggleLiked={toggleLiked} updateRating={updateRating}></Render>
    </div>
)



}