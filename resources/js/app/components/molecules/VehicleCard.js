import React from "react";
import styled from "styled-components";
import {AiFillCar} from "react-icons/ai";


export const VehicleCard = ({brand, model, seats, fuelCons, engine, active}) => {

    return (
        <Wrapper active={active}>
            <AiFillCar />
            <span><b>Marca:</b> {brand}</span>
            <span><b>Modelo:</b> {model}</span>
            <span><b>Número de plazas:</b> {seats}</span>
            <span><b>Consumo:</b> {fuelCons}</span>
        </Wrapper>
    )
}

const Wrapper = styled.div`
    padding: 0.8rem;
    margin: 0.6rem;
    display: flex;
    flex-direction: column;
    border: 1px solid grey;
    border-radius: 8px;
    background-color: ${({active}) => active ? 'white' : '#ef9797' };

    > span {
        font-size: 0.6rem;
        padding: 0.1rem 0;
    }
`
