import React from 'react';
import ReactDOM from 'react-dom';
import styled from 'styled-components';
import GlobalStyles from "./components/GlobalStyles";
import {UserProvider} from "./context/userContext";
import {BrowserRouter} from "react-router-dom";
import {Router} from "./Router";


export default function App() {

    return (
        <BrowserRouter>
            <UserProvider>
                <WrapperApp>
                    <GlobalStyles/>
                    <Router/>
                </WrapperApp>
            </UserProvider>
        </BrowserRouter>
    )
}

const WrapperApp = styled.div`
    width: 100%;
    height: 100%;
`

if (document.getElementById('react-app')) {
    ReactDOM.render(<App/>, document.getElementById('react-app'));
}
