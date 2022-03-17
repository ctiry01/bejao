import React from "react";
import styled from "styled-components";
import {useUserDispatcher} from "../../context/userContext";
import {AiFillCar} from "react-icons/ai";


export const VehicleCard = ({brand, model, seats, fuelCons, engine}) => {

    return (
        <Wrapper>
            <AiFillCar />
            <span><b>Marca:</b> {brand}</span>
            <span><b>Modelo:</b> {model}</span>
            <span><b>Número de plazas:</b> {seats}</span>
            <span><b>Consumo:</b> {fuelCons}</span>
            <span><b>Motor:</b> {engine}</span>
        </Wrapper>
    )
}

const Wrapper = styled.div`
    padding: 0.8rem;
    display: flex;
    flex-direction: column;
    border: 1px solid grey;
    border-radius: 8px;

    > span {
        font-size: 0.6rem;
        padding: 0.1rem 0;
    }
`
