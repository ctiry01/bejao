import React from 'react'
import styled from 'styled-components'
import ReactLoading from 'react-loading'

export const CustomButton = ({
                                 bgColor,
                                 color,
                                 children,
                                 radius = 16,
                                 onClick,
                                 disabled,
                                 border,
                                 icon,
                                 loading,
                                 ...others
                             }) => {
    return (
        <Rectangle
            onClick={onClick}
            bgColor={bgColor}
            color={color}
            radius={radius}
            disabled={disabled}
            border={border}
            {...others}
        >
            {icon && <WrapperIcon>{icon}</WrapperIcon>}
            {loading && <ReactLoading width="1.4rem" height="1.4rem" type="spin" color={color || 'white'}/>}
            {children}
        </Rectangle>
    )
}

const Rectangle = styled.button`
    border: ${({border}) => (border ? '1px solid ' + border : 'none')};
    border-radius: ${({radius}) => `${radius}px`};
    background-color: ${({disabled, bgColor}) => (disabled ? 'lightGrey' : bgColor ? bgColor : '#0074E7')};
    color: ${({color}) => (color ? color : 'white')};
    box-shadow: 5px 5px 15px -4px #a7aab1;
    padding: 1rem 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    user-select: none;
    column-gap: 0.5rem;
    cursor: ${({disabled}) => (disabled ? 'default' : 'pointer')};
    font-size: 1rem;

    &:hover {
        background-color: ${({disabled, bgColor}) => (disabled ? 'lightGrey' : bgColor ? bgColor : '#04509f')};
    }
`

const WrapperIcon = styled.div`
    margin-right: 0.4rem;
    height: 100%;
    display: flex;
    align-items: center;
`
