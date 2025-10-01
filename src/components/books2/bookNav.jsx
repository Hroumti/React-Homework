import React from "react";
import {Link} from 'react-router-dom'

export default function BookNav(){

    return(
        <nav>
            <Link to={'/'}>Home</Link>
            <Link to={'/book-list'}>Book list</Link>
            <Link to={'/add-book'}>Add books</Link>
        </nav>
    )
}