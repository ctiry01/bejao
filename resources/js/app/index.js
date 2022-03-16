import React from 'react';
import ReactDOM from 'react-dom';
import styled from 'styled-components';
import {Login} from "./pages/Login";
import GlobalStyles from "./components/GlobalStyles";
import {UserProvider} from "./context/userContext";


export default function App() {
    return (
        <UserProvider>
            <WrapperApp>
                <GlobalStyles/>
                <Login/>
            </WrapperApp>
        </UserProvider>
    )
}

const WrapperApp = styled.div`
    width: 100%;
    height: 100%;
`

if (document.getElementById('react-app')) {
    ReactDOM.render(<App/>, document.getElementById('react-app'));
}
