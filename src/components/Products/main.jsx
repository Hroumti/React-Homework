import React from 'react'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import ProductProvider from './context'
import NavBar from './navbar'
import Form from './form'
import About from './about'
import './style.css'

export default function Main() {
    return (
        <ProductProvider>
            <Router>
                <div className="app">
                    <NavBar />
                    <Routes>
                        <Route path="/" element={<Form />} />
                        <Route path="/about" element={<About />} />
                    </Routes>
                </div>
            </Router>
        </ProductProvider>
    )
}
