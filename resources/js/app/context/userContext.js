import React from "react";
import user from "../api/user";
import search from "../api/search";


const defaultState = {
    userData: null,
    resultData: null
}
const defaultDispatch = () => {
}

const UserContext = React.createContext(defaultState);
const UserDispatch = React.createContext(defaultDispatch);

export async function UserLogin(email, password) {
    const res = await user.login(email, password)

    localStorage.clear()
    localStorage.setItem('apikey', res.token)

    return {
        type: 'login',
        payload: res
    }
}

export async function UserRegister(name, email, password) {
    const res = await user.register(name, email, password)

    localStorage.clear()
    localStorage.setItem('apikey', res.token)

    return {
        type: 'register',
        payload: res
    }
}

export async function RequestVehicle(seats, origin, destination) {

    const res = await search.requestVehicle(seats, origin, destination, localStorage.apikey)

    return {
        type: 'search',
        payload: res
    }
}

const ContextReducer = (state, action) => {
    switch (action.type) {
        case 'logout':
            return {
                ...state
            }

        case 'login':
            return {
                ...state,
                userData: action.payload
            }

        case 'register':
            return {
                ...state,
                userData: action.payload
            }

        case 'search':
            return {
                ...state,
                resultData: action.payload
            }

        default: {
            throw new Error(`Unhandled action type: ${action.type}`);
        }
    }
};

export const UserProvider = ({children}) => {

    const [state, dispatch] = React.useReducer(
        ContextReducer,
        defaultState
    );

    return (
        <UserContext.Provider value={state}>
            <UserDispatch.Provider value={dispatch}>
                {children}
            </UserDispatch.Provider>
        </UserContext.Provider>
    );
};

export const AuthorConsumer = (props) => {
    return (
        <UserDispatch.Consumer>
            {context => {
                if (context === undefined) {
                    throw new Error(
                        'YearConsumer must be used within a UserProvider'
                    );
                }
                return props.children(context);
            }}
        </UserDispatch.Consumer>
    );
};

export const useUserState = () => {
    const context = React.useContext(UserContext);
    if (context === undefined) {
        throw new Error('useUserState must be used within a UserProvider');
    }
    return context;
};

export const useUserDispatcher = () => {
    const context = React.useContext(UserDispatch);
    if (context === undefined) {
        throw new Error('useUserDispatcher must be used within a UserProvider');
    }
    return context;
}
