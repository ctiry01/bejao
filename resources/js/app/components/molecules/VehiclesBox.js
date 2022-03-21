import React from "react";
import {useUserState} from "../../context/userContext";
import {Card} from "../atoms/Card";
import {VehicleCard} from "./VehicleCard";
import styled from "styled-components";
import {Link} from "react-router-dom";


export const VehiclesBox = ({vehicle}) => {
    const userContextState = useUserState();

    if (!userContextState.userData) return null
    if (!userContextState.userData.user) return null

    return (
        <Card>
            <Title>Tus vehículos</Title>
            <WrapperVehicles>
                {userContextState.userData.user.vehicle &&
                    <VehicleCard
                        key={userContextState.userData.user.vehicle.key}
                        brand={userContextState.userData.user.vehicle.brand}
                        engine={userContextState.userData.user.vehicle.engine}
                        fuelCons={userContextState.userData.user.vehicle.fuel_consumption}
                        model={userContextState.userData.user.vehicle.model}
                        seats={userContextState.userData.user.vehicle.seats}
                        active={userContextState.userData.user.vehicle.active}
                    />
                }

                {!userContextState.userData.user.vehicle &&
                    <p>No hay vehículos</p>
                }

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
