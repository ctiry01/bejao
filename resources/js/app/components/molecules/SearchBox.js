import React, {useState} from "react";
import styled from "styled-components";
import {CustomButton} from "../atoms/CustomButton";
import CustomInput from "../atoms/CustomInput";
import {RequestVehicle, useUserDispatcher} from "../../context/userContext";
import {Card} from "../atoms/Card";
import {Separator} from "../atoms/Separator";


export const SearchBox = () => {
    const [seats, setSeats] = useState();
    const [origin, setOrigin] = useState();
    const [destination, setDestination] = useState();

    const userContextDispatcher = useUserDispatcher();

    const onSubmmit = () => {
        RequestVehicle(seats, origin, destination)
            .then((r) => {
                userContextDispatcher(r)
            }).catch((e) => {
            console.log('error')
        })
    }

    return (
        <Card>
            <Title>Encuentra un coche para compartir</Title>
            <CustomInput placeholder={'numero de pasajeros'} type={'number'} onChange={(e) => setSeats(e.target.value)}/>
            <Separator/>
            <CustomInput placeholder={'ciudad origen'} onChange={(e) => setOrigin(e.target.value)}/>
            <Separator/>
            <CustomInput placeholder={'ciudad destino'} onChange={(e) => setDestination(e.target.value)}/>
            <Separator/>
            <CustomButton onClick={onSubmmit}>Buscar</CustomButton>
        </Card>
    )
}

const Title = styled.h2`
    margin-top: 0;
    text-align: center;
`


