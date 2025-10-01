import { Link } from 'react-router-dom';

const NavBar = () => (
  <nav className='navbar'>
    <Link to="/" style={{ color: 'white', textDecoration: 'none' }}>Home (Manager)</Link>
    <Link to="/about" style={{ color: 'white', textDecoration: 'none' }}>About</Link>
  </nav>
);

export default NavBar 