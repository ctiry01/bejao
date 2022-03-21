import React from "react";
import styled from "styled-components";
import {LoginFormCard} from "../components/molecules/LoginFormCard";

export const Login = () => {

    return (
        <WrapperLogin>
            <LoginFormCard/>
        </WrapperLogin>
    )
}

const WrapperLogin = styled.div`
    width: 100%;
    min-height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
`
