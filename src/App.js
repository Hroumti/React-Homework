import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import ProductProvider from './components/products/context';

import ProductForm from './components/products/form';
import About from './components/products/about'; 
import NavBar from './components/products/navbar'

import './components/products/style.css'



function App() {
  return (
    <BrowserRouter> 
      <ProductProvider>
        
        <NavBar /> 
        
        <main className="root-container">
          <Routes>
            
            
            <Route path="/" element={<ProductForm />} /> 
            
            <Route path="/about" element={<About />} />
            
            <Route path="*" element={<h2>404 Page Not Found</h2>} />
          </Routes>
        </main>
        
      </ProductProvider>
    </BrowserRouter>
  );
}

export default App;