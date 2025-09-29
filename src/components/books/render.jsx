import React, {useState, useRef, useEffect} from "react";
import { FaBeer, FaTrash, FaStar, FaThumbsUp } from 'react-icons/fa';

export default function Render({books, deleteBook, toggleLiked, updateRating}){



    return(
        <div className="render-books">
            {books&&(books.map(b=>(
                <div className="book-card" key={b.id}>
                    <span className="upwards">
                        <h1>{b.title}</h1>
                        <p>{b.author}</p>
                    </span>
                    <span className="bottom">
                        <span className="rating">
                        <FaStar color="gold" data-id="1" onClick={()=>updateRating(b.id, 1)} style={{color:b.rating<=1?"gold":"silver"}}/>
                        <FaStar color="gold" data-id="2" onClick={()=>updateRating(b.id, 2)} style={{color:b.rating<=2?"gold":"silver"}}/>
                        <FaStar color="gold" data-id="3" onClick={()=>updateRating(b.id, 3)} style={{color:b.rating<=3?"gold":"silver"}}/>
                        <FaStar color="gold" data-id="4" onClick={()=>updateRating(b.id, 4)} style={{color:b.rating<=4?"gold":"silver"}}/>
                        <FaStar color="gold" data-id="5" onClick={()=>updateRating(b.id, 5)} style={{color:b.rating<=5?"gold":"silver"}}/>
                    </span>
                    <span className="actions">
                        <FaTrash onClick={()=>deleteBook(b.id)}/>
                        <FaThumbsUp onClick={()=>toggleLiked(b.id)} style={{color:b.liked?"blue":"silver"}}/>
                    </span>
                    </span>
                </div>
            )))}
        </div>
    )



}