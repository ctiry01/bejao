import React from "react";
import styled from "styled-components";
import {RegisterFormCard} from "../components/molecules/RegisterFormCard";

export const Register = () => {

    return (
        <WrapperLogin>
            <RegisterFormCard/>
        </WrapperLogin>
    )
}

const WrapperLogin = styled.div`
    width: 100%;
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
`
