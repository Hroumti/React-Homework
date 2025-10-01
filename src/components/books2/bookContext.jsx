import React, {useState, createContext, useEffect} from 'react'

export const BookContext = createContext()

export default function BookProvider({children}){
    const [books, setBooks] = useState([])
    const [currId, setCurrId] = useState(0)

    useEffect(()=>{
        fetch('/books.json')
        .then(res=>{
            if(!res.ok){
                throw new Error(`Failed to fetch data ${res.status}`)
            }
            return res.json()
        })
        .then(data=>{
            setBooks(data.books)
            setCurrId(data.books.length+1)
        })
        .catch(err => console.error("Data Fetch Error:", err));
    },[])
    

    function addBook(book){
        setBooks([...books, {...book, id:currId}])
        setCurrId(currId+1)
    }

    function updateBook(book){
        setBooks(books.map(b=>(b.id===book.id?book:b)))
    }

    function removeBook(bookId){
        setBooks(books.filter(b=>b.id!==bookId))
    }

    return(
        <BookContext.Provider value={{books, addBook, updateBook, removeBook}}>
            {children}
        </BookContext.Provider>
    )
}