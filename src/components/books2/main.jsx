import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

import BookNav from './bookNav';
import BookList from './bookList';
import BookProvider from './bookContext';
import BookAddForm from './bookAddForm';
import BookEditForm from './bookEditForm';

import './style.css'



export default function Main() {
  return (
    <BrowserRouter> 
      <BookProvider>
        <BookNav/>
        <div className='content-wrapper'>
          <Routes>
          <Route path='/' element={<h1>Welcome to our website!!!</h1>}/>
          <Route path='/book-list' element={<BookList/>}/>
          <Route path='/add-book' element={<BookAddForm/>}/>
          <Route path='/edit/:id' element={<BookEditForm/>}/>
          <Route path='/*' element={<h1>404 page not found</h1>}/>
        </Routes>
        </div>
      </BookProvider>
    </BrowserRouter>
  );
}

