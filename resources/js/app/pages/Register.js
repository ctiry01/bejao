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
    min-height: 80vh;
    margin: 3rem 0;
    display: flex;
    justify-content: center;
    align-items: center;
`
