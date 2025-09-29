import React, { useRef, useState } from 'react';

function Form() {

    const nameRef = useRef(null);
    const emailRef = useRef(null);
    const pwdRef = useRef(null);
    const ageRef = useRef(null);
    const genderMaleRef = useRef(null);
    const genderFemaleRef = useRef(null);
    const cityRef = useRef(null);
    const termsRef = useRef(null);
    
    const [nameError, setNameError] = useState('');
    const [emailError, setEmailError] = useState('');
    const [pwdError, setPwdError] = useState('');
    const [ageError, setAgeError] = useState('');
    const [genderError, setGenderError] = useState('');
    const [cityError, setCityError] = useState('');
    const [termsError, setTermsError] = useState('');
    const [submittedData, setSubmittedData] = useState(null);

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const pwdRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

    function handleSubmit(event) {
        event.preventDefault();
        let isValid = true;

        setNameError('');
        setEmailError('');
        setPwdError('');
        setAgeError('');
        setGenderError('');
        setCityError('');
        setTermsError('');

        const name = nameRef.current.value;
        const email = emailRef.current.value;
        const pwd = pwdRef.current.value;
        const age = ageRef.current.value;
        const gender = genderMaleRef.current.checked ? genderMaleRef.current.value : (genderFemaleRef.current.checked ? genderFemaleRef.current.value : '');
        const city = cityRef.current.value;
        const terms = termsRef.current.checked;

        if (name.trim() === '' || name.length < 2) {
            setNameError('Name must be at least 2 characters long.');
            isValid = false;
        }

        if (!emailRegex.test(email)) {
            setEmailError('Please enter a valid email address.');
            isValid = false;
        }

        if (!pwdRegex.test(pwd)) {
            setPwdError('Password must be at least 8 characters long and contain at least one letter and one number.');
            isValid = false;
        }

        if (Number(age) < 18 || Number(age) > 99) {
            setAgeError('You must be between 18 and 99 years old.');
            isValid = false;
        }

        if (gender === '') {
            setGenderError('Please select your gender.');
            isValid = false;
        }

        if (city === '') {
            setCityError('Please select a city.');
            isValid = false;
        }

        if (!terms) {
            setTermsError('You must accept the terms and conditions.');
            isValid = false;
        }

        if (isValid) {
            const formData = {
                name,
                email,
                pwd,
                age,
                gender,
                city,
                terms
            };
            setSubmittedData(formData);
        } else {
            setSubmittedData(null);
        }
    }

    return(
        <>
        <form id='form' onSubmit={handleSubmit}>
            <div className="input-group">
                <p>Name:</p>
                <input type="text" ref={nameRef} />
                {nameError && <span className='error'>{nameError}</span>}
            </div>
            <div className="input-group">
                <p>email:</p>
                <input type="email" ref={emailRef} />
                {emailError && <span className='error'>{emailError}</span>}
            </div>
            <div className="input-group">
                <p>Password:</p>
                <input type="password" ref={pwdRef} />
                {pwdError && <span className='error'>{pwdError}</span>}
            </div>
            <div className="input-group">
                <p>Age:</p>
                <input type="number" ref={ageRef} />
                {ageError && <span className='error'>{ageError}</span>}
            </div>
            <div className="input-group">
                <p>Gender:</p>
                <label>
                    <input type="radio" name='gender' value='Male' ref={genderMaleRef} />Male
                </label>
                <label>
                    <input type="radio" name='gender' value='Female' ref={genderFemaleRef} />Female
                </label>
                {genderError && <span className='error'>{genderError}</span>}
            </div>
            <div className="input-group">
                <p>City:</p>
                <select name="city" id="city" ref={cityRef}>
                    <option value="" disabled>-------------</option>
                    <option value="city1">City 1</option>
                    <option value="city2">City 2</option>
                    <option value="city3">City 3</option>
                </select>
                {cityError && <span className='error'>{cityError}</span>}
            </div>
            <div className="input-group">
                <label>
                    <input type="checkbox" ref={termsRef} />
                    Accept terms and conditions
                </label>
                {termsError && <span className='error'>{termsError}</span>}
            </div>
            <input type="submit" value='Submit'/>
        </form>
        {submittedData && (
            <div className="user-data">
                <h2>Submitted Data</h2>
                <p><strong>Name:</strong> {submittedData.name}</p>
                <p><strong>Email:</strong> {submittedData.email}</p>
                <p><strong>Password:</strong> {submittedData.pwd}</p>
                <p><strong>Age:</strong> {submittedData.age}</p>
                <p><strong>Gender:</strong> {submittedData.gender}</p>
                <p><strong>City:</strong> {submittedData.city}</p>
                <p><strong>Terms:</strong> {submittedData.terms ? 'Accepted' : 'Not Accepted'}</p>
            </div>
        )}
        </>
    );
}

export default Form;