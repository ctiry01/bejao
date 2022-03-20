import React from "react";
import {useUserState} from "../../context/userContext";
import {Card} from "../atoms/Card";
import {VehicleCard} from "./VehicleCard";
import styled from "styled-components";


export const VehiclesBox = () => {
    const userContextState = useUserState();

    if (!userContextState.userData) return null

    console.log(userContextState.userData.user.vehicle)
    return (
        <Card>
            <Title>Tus vehículos</Title>
            <WrapperVehicles>
                {userContextState.userData.user.vehicle &&
                    <VehicleCard
                        key={vehicle.key}
                        brand={vehicle.brand}
                        engine={vehicle.engine}
                        fuelCons={vehicle.fuel_consumption}
                        model={vehicle.model}
                        seats={vehicle.seats}
                        active={vehicle.active}
                    />
                }
                {userContextState.userData.user.vehicle.length <= 0 && <p>No tienes vehículos dados de alta</p>}
            </WrapperVehicles>
        </Card>
    )
}


const WrapperVehicles = styled.div`
    display: flex;
    flex-wrap: wrap;
`

const Title = styled.h2`
    margin-top: 0;
    text-align: center;
`
