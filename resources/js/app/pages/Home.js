import React, {useEffect} from "react";
import styled from "styled-components";
import {useUserState} from "../context/userContext";
import {useNavigate} from "react-router-dom";
import {SearchBox} from "../components/molecules/SearchBox";
import {VehiclesBox} from "../components/molecules/VehiclesBox";
import {Separator} from "../components/atoms/Separator";
import {Card} from "../components/atoms/Card";

export const Home = () => {
    const navigate = useNavigate();
    const userContextState = useUserState();

    //console.log(userContextState)

    useEffect(() => {
        if (!(userContextState.userData && userContextState.userData.token)) {
            navigate('/', {replace: true})
        }
    }, [userContextState])

    if (!userContextState.userData) return null
    if (!userContextState.userData.user) return null

    return (
        <WrapperLogin>
            <Card>
                <h1>¡Hola {userContextState.userData.user.name}!</h1>
            </Card>
            <Separator />
            <VehiclesBox />
            <Separator />
            <SearchBox />
        </WrapperLogin>
    )
}

const WrapperLogin = styled.div`
    width: 100%;
    height: 80vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
`
