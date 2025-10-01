import React, {useContext} from 'react'
import { BookContext } from './bookContext'
import {Link} from 'react-router-dom'

export default function BookList(){
    const {books, removeBook} = useContext(BookContext)

    return(
        <div className="book-list-contaimer">
            {books&&(books.map(b=>(
                <div className="book-card" key={b.id}>
                    <h3>{b.title}</h3>
                    <p>{b.author}</p>
                    <span className="buttons">
                        <button className="edit"><Link to={`/edit/${b.id}`}>Edit</Link></button>
                        <button className='remove' onClick={()=>removeBook(b.id)}>Remove</button>
                    </span>
                </div>
            )))}
        </div>
    )
}